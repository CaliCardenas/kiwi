<?php
/**
 * Plugin Name: Kiwi Producto
 * Description: Ajustes de ficha y listado: precio dentro del botón de agregar, conteo «N piezas» y galería con puntos.
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
 * Galería de la ficha: puntos de paginación en vez de miniaturas (§1 del handoff).
 */
add_filter(
	'woocommerce_single_product_carousel_options',
	static function ( array $opciones ): array {
		$opciones['controlNav']   = true;
		$opciones['directionNav'] = false;

		return $opciones;
	}
);
