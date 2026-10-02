<?php
/**
 * Title: Columnas de enlaces del footer
 * Slug: kiwi/navegacion-pie
 * Inserter: no
 *
 * Menús «menu-pie-comprar» y «menu-pie-ayuda», editables desde Apariencia › Editor › Navegación.
 *
 * @package kiwi
 */

$kiwi_columnas = array(
	'menu-pie-comprar' => _x( 'Comprar', 'columna del footer', 'kiwi' ),
	'menu-pie-ayuda'   => _x( 'Ayuda', 'columna del footer', 'kiwi' ),
);

foreach ( $kiwi_columnas as $kiwi_slug => $kiwi_titulo ) :
	$kiwi_ref = kiwi_menu_id( $kiwi_slug );
	?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical"}} -->
<div class="wp-block-group">
<!-- wp:paragraph {"textColor":"texto-debil","fontSize":"10","fontFamily":"karla","style":{"typography":{"fontWeight":"700","letterSpacing":"0.14em","textTransform":"uppercase"}}} -->
<p class="has-texto-debil-color has-text-color has-karla-font-family has-10-font-size" style="font-weight:700;letter-spacing:0.14em;text-transform:uppercase"><?php echo esc_html( $kiwi_titulo ); ?></p>
<!-- /wp:paragraph -->
	<?php if ( $kiwi_ref ) : ?>
<!-- wp:navigation {"ref":<?php echo (int) $kiwi_ref; ?>,"overlayMenu":"never","className":"kiwi-nav-pie","textColor":"crema","fontSize":"14","fontFamily":"karla","style":{"typography":{"fontWeight":"400"},"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical"}} /-->
	<?php endif; ?>
</div>
<!-- /wp:group -->
	<?php
endforeach;
