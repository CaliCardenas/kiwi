<?php
/**
 * Title: Navegación principal
 * Slug: kiwi/navegacion-principal
 * Inserter: no
 *
 * Menú «menu-principal», editable desde Apariencia › Editor › Navegación.
 * Si el menú no existe no se imprime nada (evita que WordPress invente uno con la lista de páginas).
 *
 * @package kiwi
 */

$kiwi_ref = kiwi_menu_id( 'menu-principal' );

if ( ! $kiwi_ref ) {
	return;
}
?>
<!-- wp:navigation {"ref":<?php echo (int) $kiwi_ref; ?>,"overlayMenu":"never","className":"kiwi-nav kiwi-solo-escritorio","textColor":"grafito","fontSize":"14","fontFamily":"karla","style":{"typography":{"fontWeight":"700"},"spacing":{"blockGap":"var:preset|spacing|60"}},"layout":{"type":"flex","flexWrap":"nowrap"}} /-->
