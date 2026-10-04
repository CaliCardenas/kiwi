<?php
/**
 * Descripción larga de la ficha (revisión 7, B1).
 *
 * Dos marcados del mismo contenido: tres columnas en escritorio y acordeón en
 * móvil. Cada uno se oculta con display:none en el otro ancho, así el lector de
 * pantalla solo encuentra uno. El acordeón es <details>: abre y cierra sin JS.
 *
 * @package kiwi-producto
 *
 * @var array    $attributes Atributos del bloque.
 * @var string   $content    Contenido interno (vacío).
 * @var WP_Block $block      Instancia del bloque.
 */

defined( 'ABSPATH' ) || exit;

$kiwi_id       = (int) ( $block->context['postId'] ?? get_the_ID() );
$kiwi_producto = wc_get_product( $kiwi_id );

if ( ! $kiwi_producto instanceof WC_Product ) {
	return;
}

$kiwi_partes = kiwi_producto_partes_descripcion( $kiwi_producto->get_description() );

if ( '' === $kiwi_partes['intro'] && ! $kiwi_partes['secciones'] ) {
	return;
}

$kiwi_titulos = kiwi_producto_titulos_descripcion();
?>
<section <?php echo get_block_wrapper_attributes( array( 'class' => 'kiwi-detalles' ) ); ?> aria-labelledby="kiwi-detalles-titulo">
	<div class="kiwi-detalles__escritorio kiwi-solo-escritorio">
		<h2 id="kiwi-detalles-titulo" class="kiwi-detalles__titulo"><?php esc_html_e( 'Detalles', 'kiwi-producto' ); ?></h2>
		<div class="kiwi-detalles__cuerpo">
			<?php if ( '' !== $kiwi_partes['intro'] ) : ?>
				<div class="kiwi-detalles__intro"><?php echo wp_kses_post( $kiwi_partes['intro'] ); ?></div>
			<?php endif; ?>
			<?php if ( $kiwi_partes['secciones'] ) : ?>
				<div class="kiwi-detalles__columnas">
					<?php foreach ( $kiwi_partes['secciones'] as $kiwi_clave => $kiwi_html ) : ?>
						<div class="kiwi-detalles__columna">
							<h3 class="kiwi-detalles__subtitulo"><?php echo esc_html( $kiwi_titulos[ $kiwi_clave ] ); ?></h3>
							<div class="kiwi-detalles__texto"><?php echo wp_kses_post( $kiwi_html ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="kiwi-detalles__movil kiwi-solo-movil">
		<?php if ( '' !== $kiwi_partes['intro'] ) : ?>
			<details class="kiwi-acordeon" open>
				<summary class="kiwi-acordeon__cabecera"><?php esc_html_e( 'Descripción', 'kiwi-producto' ); ?></summary>
				<div class="kiwi-acordeon__texto"><?php echo wp_kses_post( $kiwi_partes['intro'] ); ?></div>
			</details>
		<?php endif; ?>
		<?php foreach ( $kiwi_partes['secciones'] as $kiwi_clave => $kiwi_html ) : ?>
			<details class="kiwi-acordeon">
				<summary class="kiwi-acordeon__cabecera"><?php echo esc_html( $kiwi_titulos[ $kiwi_clave ] ); ?></summary>
				<div class="kiwi-acordeon__texto"><?php echo wp_kses_post( $kiwi_html ); ?></div>
			</details>
		<?php endforeach; ?>
	</div>
</section>
