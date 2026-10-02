<?php
/**
 * Title: Logo del footer
 * Slug: kiwi/logo-pie
 * Inserter: no
 *
 * @package kiwi
 */

?>
<!-- wp:image {"width":"auto","height":"var(--wp--preset--dimension--logo)","sizeSlug":"full","linkDestination":"custom","href":"<?php echo esc_url( home_url( '/' ) ); ?>","className":"kiwi-logo"} -->
<figure class="wp-block-image size-full is-resized kiwi-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/logo/kiwi-monocromo-negativo.svg' ) ); ?>" alt="<?php echo esc_attr_x( 'Kiwi', 'nombre de la marca', 'kiwi' ); ?>" style="width:auto;height:var(--wp--preset--dimension--logo)"/></a></figure>
<!-- /wp:image -->
