<?php
/**
 * Tema Kiwi: solo presentación (estilos y patterns). La lógica va en plugins kiwi-*.
 *
 * @package kiwi
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'wp_enqueue_scripts',
	static function () {
		wp_enqueue_style(
			'kiwi',
			get_theme_file_uri( 'assets/css/kiwi.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
);

add_action(
	'after_setup_theme',
	static function () {
		add_editor_style( 'assets/css/kiwi.css' );
	}
);

/**
 * ID del menú de navegación (wp_navigation) con ese slug, para que los patterns
 * apunten a un menú editable desde el editor de sitio sin fijar IDs en las plantillas.
 * Un menú sin ítems cuenta como inexistente: así no se imprime un <nav> vacío,
 * que los lectores de pantalla anuncian como una región sin contenido.
 *
 * @param string $slug Slug del menú.
 * @return int ID, o 0 si el menú no existe o está vacío.
 */
function kiwi_menu_id( string $slug ): int {
	$ids = get_posts(
		array(
			'post_type'      => 'wp_navigation',
			'name'           => $slug,
			'post_status'    => 'publish',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	if ( ! $ids || '' === trim( (string) get_post_field( 'post_content', $ids[0] ) ) ) {
		return 0;
	}

	return (int) $ids[0];
}
