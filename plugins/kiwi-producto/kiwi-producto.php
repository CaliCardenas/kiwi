<?php
/**
 * Plugin Name: Kiwi Producto
 * Description: Ajustes de ficha y listado: precio dentro del botón de agregar, conteo «N piezas», orden del catálogo y descripción larga por secciones.
 * Version: 0.1.0
 * Requires at least: 6.6
 * Requires PHP: 8.1
 * Requires Plugins: woocommerce
 * Author: Motuchisoft
 * License: GPL-2.0-or-later
 * Text Domain: kiwi-producto
 */

defined( 'ABSPATH' ) || exit;

/**
 * Precio en texto plano con el formato de la tienda (₡15.000), sin el HTML de wc_price().
 *
 * @param float $precio Monto.
 * @return string
 */
function kiwi_producto_precio_plano( float $precio ): string {
	return html_entity_decode( wp_strip_all_tags( wc_price( $precio ) ), ENT_QUOTES, 'UTF-8' );
}

/**
 * Botón de la ficha: «Agregar · ₡15.000». El precio va en el botón (§1 del handoff).
 * En un producto variable se usa el precio del producto: todas las tallas de una
 * pieza valen igual (decisión de la dueña, octubre 2026).
 */
add_filter(
	'woocommerce_product_single_add_to_cart_text',
	static function ( $texto, $producto ) {
		if ( ! $producto instanceof WC_Product || '' === $producto->get_price() ) {
			return $texto;
		}

		return sprintf(
			/* translators: %s: precio del producto, p. ej. ₡15.000. */
			__( 'Agregar · %s', 'kiwi-producto' ),
			kiwi_producto_precio_plano( (float) $producto->get_price() )
		);
	},
	10,
	2
);

/**
 * Conteo del listado: «N piezas» en lugar de «Mostrando los N resultados».
 * El bloque nativo imprime la plantilla loop/result-count.php; se reemplaza solo el texto.
 */
add_filter(
	'render_block_woocommerce/product-results-count',
	static function ( string $html ): string {
		$total = (int) wc_get_loop_prop( 'total' );

		if ( ! $total && isset( $GLOBALS['wp_query'] ) ) {
			$total = (int) $GLOBALS['wp_query']->found_posts;
		}

		$texto = sprintf(
			/* translators: %s: cantidad de productos. */
			_n( '%s pieza', '%s piezas', $total, 'kiwi-producto' ),
			number_format_i18n( $total )
		);

		return (string) preg_replace_callback(
			'#(<p\b[^>]*class="[^"]*woocommerce-result-count[^"]*"[^>]*>).*?(</p>)#s',
			static fn ( array $m ): string => $m[1] . esc_html( $texto ) . $m[2],
			$html
		);
	}
);

/**
 * Opciones del selector de orden. Sin «valoración»: la tienda no muestra reseñas.
 * Sin «orden predeterminado»: el orden por defecto es «Más nuevos» (handoff, State Management).
 */
add_filter(
	'woocommerce_catalog_orderby',
	static function ( array $opciones ): array {
		unset( $opciones['rating'], $opciones['menu_order'] );

		if ( isset( $opciones['date'] ) ) {
			$opciones['date'] = __( 'Más nuevos', 'kiwi-producto' );
		}

		return $opciones;
	}
);

/**
 * Migas de la ficha (revisión 7, A1): cada miga en un span, así el tema puede
 * marcar la actual, y la barra como separador que el lector de pantalla no lee.
 */
add_filter(
	'woocommerce_breadcrumb_defaults',
	static function ( array $args ): array {
		$args['delimiter'] = '<span class="kiwi-migas__separador" aria-hidden="true">/</span>';
		$args['before']    = '<span class="kiwi-migas__item">';
		$args['after']     = '</span>';

		return $args;
	}
);

/**
 * Bloque de descripción larga de la ficha.
 */
add_action(
	'init',
	static function () {
		register_block_type( __DIR__ . '/bloques/descripcion' );
		register_block_type( __DIR__ . '/bloques/relacionados-encabezado' );
	}
);

/**
 * Categoría principal de una pieza: la más profunda, con el mismo criterio que
 * las migas de Woo, así el título «Más {categoría}» coincide con la miga.
 *
 * @param int $producto_id ID del producto.
 * @return WP_Term|null
 */
function kiwi_producto_categoria_principal( int $producto_id ): ?WP_Term {
	$terminos = wc_get_product_terms(
		$producto_id,
		'product_cat',
		array(
			'orderby' => 'parent',
			'order'   => 'DESC',
		)
	);

	return $terminos && $terminos[0] instanceof WP_Term ? $terminos[0] : null;
}

/**
 * Relacionados de la ficha (revisión 7, B2): la colección nativa «related» de Woo,
 * configurada en la plantilla solo por categoría y con los más nuevos primero.
 * Si hay menos de 2 piezas además de la actual, el bloque no se muestra: una sola
 * sugerencia da impresión de catálogo vacío (decisión de la dueña, octubre 2026).
 *
 * Se cuentan las cards ya renderizadas y no wc_get_related_products(): Woo cachea
 * esos IDs por producto y no limpia el caché de las demás piezas cuando una pasa a
 * borrador, así que contaría piezas que la colección ya no muestra.
 */
add_filter(
	'render_block_woocommerce/product-collection',
	static function ( string $html, array $bloque ): string {
		if ( ! str_contains( (string) ( $bloque['attrs']['className'] ?? '' ), 'kiwi-relacionados' ) ) {
			return $html;
		}

		$cards = preg_match_all( '/<li\b[^>]*\bclass="[^"]*\bwc-block-product\b/', $html );

		return $cards < 2 ? '' : $html;
	},
	10,
	2
);

/**
 * Secciones fijas de la descripción larga, en orden (revisión 7, B1).
 * Las claves son el texto del encabezado normalizado.
 *
 * @return array<string, string> Clave => título que se muestra.
 */
function kiwi_producto_titulos_descripcion(): array {
	return array(
		'material'        => __( 'Material', 'kiwi-producto' ),
		'calce y medidas' => __( 'Calce y medidas', 'kiwi-producto' ),
		'cuidado'         => __( 'Cuidado', 'kiwi-producto' ),
	);
}

/**
 * Parte la descripción de Woo en el párrafo inicial y las tres secciones fijas.
 *
 * La dueña escribe en Woo un párrafo y los encabezados «Material», «Calce y
 * medidas» y «Cuidado» (cualquier nivel de h2 a h6, sin importar mayúsculas).
 * Un encabezado que no es de los tres queda, con su texto, dentro de la parte
 * anterior: así no se pierde contenido. Las secciones vacías se omiten.
 *
 * @param string $descripcion Descripción del producto (HTML o texto con saltos).
 * @return array{intro: string, secciones: array<string, string>}
 */
function kiwi_producto_partes_descripcion( string $descripcion ): array {
	$partes = array(
		'intro'     => '',
		'secciones' => array(),
	);

	if ( '' === trim( $descripcion ) ) {
		return $partes;
	}

	$html    = (string) apply_filters( 'the_content', $descripcion );
	$titulos = kiwi_producto_titulos_descripcion();
	$trozos  = preg_split( '#(<h([2-6])\b[^>]*>(.*?)</h\2>)#is', $html, -1, PREG_SPLIT_DELIM_CAPTURE );

	if ( false === $trozos ) {
		$partes['intro'] = trim( $html );
		return $partes;
	}

	// $trozos: [texto, encabezado, nivel, título, texto, encabezado, nivel, título, texto, …].
	$textos = array( 'intro' => $trozos[0] );
	$actual = 'intro';

	for ( $i = 1, $total = count( $trozos ); $i < $total; $i += 4 ) {
		$clave = strtolower( trim( preg_replace( '/\s+/u', ' ', wp_strip_all_tags( $trozos[ $i + 2 ] ) ) ) );
		$texto = $trozos[ $i + 3 ] ?? '';

		if ( isset( $titulos[ $clave ] ) ) {
			$actual            = $clave;
			$textos[ $actual ] = ( $textos[ $actual ] ?? '' ) . $texto;
		} else {
			$textos[ $actual ] .= $trozos[ $i ] . $texto;
		}
	}

	$partes['intro'] = trim( $textos['intro'] );

	foreach ( array_keys( $titulos ) as $clave ) {
		if ( isset( $textos[ $clave ] ) && '' !== trim( wp_strip_all_tags( $textos[ $clave ] ) ) ) {
			$partes['secciones'][ $clave ] = trim( $textos[ $clave ] );
		}
	}

	return $partes;
}
