<?php
/**
 * Plugin Name: Kiwi WhatsApp
 * Description: Número de WhatsApp de la tienda en un solo lugar. Las plantillas y los menús enlazan a /whatsapp/ y este plugin lo convierte en el enlace wa.me.
 * Version: 0.1.0
 * Requires at least: 6.6
 * Requires PHP: 8.1
 * Author: Motuchisoft
 * License: GPL-2.0-or-later
 * Text Domain: kiwi-whatsapp
 */

defined( 'ABSPATH' ) || exit;

/**
 * Número de WhatsApp de la tienda (Ana), en formato internacional sin «+» ni espacios.
 * Es la única copia del número en el código: si cambia, se cambia acá.
 */
const KIWI_WHATSAPP_NUMERO = '50685569119';

/**
 * Ruta interna que usan plantillas y menús en lugar del número.
 */
const KIWI_WHATSAPP_RUTA = '/whatsapp/';

/**
 * Enlace wa.me al chat de la tienda.
 *
 * @return string
 */
function kiwi_whatsapp_url(): string {
	return 'https://wa.me/' . KIWI_WHATSAPP_NUMERO;
}

/**
 * Reescribe en el HTML de cada bloque los enlaces a la ruta interna por el enlace wa.me,
 * así el visitante ve y abre el destino real sin pasar por una redirección.
 */
add_filter(
	'render_block',
	static function ( string $html ): string {
		if ( ! str_contains( $html, KIWI_WHATSAPP_RUTA ) ) {
			return $html;
		}

		$internas = array_unique(
			array(
				KIWI_WHATSAPP_RUTA,
				home_url( KIWI_WHATSAPP_RUTA ),
			)
		);

		foreach ( $internas as $interna ) {
			$html = str_replace( 'href="' . esc_url( $interna ) . '"', 'href="' . esc_url( kiwi_whatsapp_url() ) . '"', $html );
		}

		return $html;
	}
);

/**
 * Red de seguridad: si algún enlace a /whatsapp/ llega sin reescribir (contenido
 * fuera de bloques, enlaces viejos), se redirige al chat.
 */
add_action(
	'template_redirect',
	static function () {
		$pedida = wp_parse_url( (string) ( $_SERVER['REQUEST_URI'] ?? '' ), PHP_URL_PATH ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput
		$ruta   = wp_parse_url( home_url( KIWI_WHATSAPP_RUTA ), PHP_URL_PATH );

		if ( is_string( $pedida ) && untrailingslashit( $pedida ) === untrailingslashit( (string) $ruta ) ) {
			wp_redirect( kiwi_whatsapp_url(), 302, 'Kiwi' ); // phpcs:ignore WordPress.Security.SafeRedirect.wp_redirect_wp_redirect -- destino externo fijo.
			exit;
		}
	}
);
