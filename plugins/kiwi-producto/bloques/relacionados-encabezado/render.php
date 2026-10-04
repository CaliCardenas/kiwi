<?php
/**
 * Encabezado de los productos relacionados (revisión 7, B2): «Más {categoría}» y,
 * solo en escritorio, «Ver todos» a la categoría (sin flecha: no está en el set).
 *
 * La fila va en un div interno: Woo inyecta su contenedor de avisos como primer
 * hijo del primer bloque de la colección, y no debe entrar en la fila flex.
 *
 * @package kiwi-producto
 *
 * @var array    $attributes Atributos del bloque.
 * @var string   $content    Contenido interno (vacío).
 * @var WP_Block $block      Instancia del bloque.
 */

defined( 'ABSPATH' ) || exit;

$kiwi_categoria = kiwi_producto_categoria_principal( (int) ( $block->context['postId'] ?? get_the_ID() ) );

if ( ! $kiwi_categoria ) {
	return;
}

$kiwi_enlace = get_term_link( $kiwi_categoria );
$kiwi_titulo = sprintf(
	/* translators: %s: nombre de la categoría en minúsculas, p. ej. «vestidos». */
	__( 'Más %s', 'kiwi-producto' ),
	mb_strtolower( $kiwi_categoria->name )
);
?>
<div <?php echo get_block_wrapper_attributes( array( 'class' => 'kiwi-relacionados__encabezado' ) ); ?>>
	<div class="kiwi-relacionados__fila">
		<h2 class="kiwi-relacionados__titulo"><?php echo esc_html( $kiwi_titulo ); ?></h2>
		<?php if ( ! is_wp_error( $kiwi_enlace ) ) : ?>
			<a class="kiwi-relacionados__ver-todos kiwi-solo-escritorio" href="<?php echo esc_url( $kiwi_enlace ); ?>"><?php esc_html_e( 'Ver todos', 'kiwi-producto' ); ?></a>
		<?php endif; ?>
	</div>
</div>
