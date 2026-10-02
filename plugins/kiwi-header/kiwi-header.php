<?php
/**
 * Plugin Name: Kiwi Header
 * Description: Bloque «Carrito» del header: enlace a la página de carrito con el conteo de piezas.
 * Version: 0.1.0
 * Requires at least: 6.6
 * Requires PHP: 8.1
 * Requires Plugins: woocommerce
 * Author: Motuchisoft
 * License: GPL-2.0-or-later
 * Text Domain: kiwi-header
 * Domain Path: /languages
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'init',
	static function () {
		register_block_type( __DIR__ . '/bloques/carrito' );
	}
);

/**
 * Devuelve un icono del set del tema (themes/kiwi/assets/icons/) listo para
 * insertar en línea: sin metadatos y marcado como decorativo.
 *
 * @param string $nombre Nombre del archivo, sin extensión.
 * @return string SVG, o cadena vacía si el tema no tiene ese icono.
 */
function kiwi_header_icono( string $nombre ): string {
	static $cache = array();

	if ( isset( $cache[ $nombre ] ) ) {
		return $cache[ $nombre ];
	}

	$ruta = get_theme_file_path( 'assets/icons/' . sanitize_file_name( $nombre ) . '.svg' );
	$svg  = is_readable( $ruta ) ? (string) file_get_contents( $ruta ) : ''; // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

	// Los SVG traen un manifiesto C2PA de varios KB que no hace falta en cada página.
	$svg = (string) preg_replace( '#<metadata\b.*?</metadata>#s', '', $svg );

	$etiqueta = new WP_HTML_Tag_Processor( $svg );
	if ( $etiqueta->next_tag( 'svg' ) ) {
		$etiqueta->remove_attribute( 'xmlns:c2pa' );
		$etiqueta->set_attribute( 'aria-hidden', 'true' );
		$etiqueta->set_attribute( 'focusable', 'false' );
		$svg = $etiqueta->get_updated_html();
	} else {
		$svg = '';
	}

	$cache[ $nombre ] = $svg;
	return $svg;
}
