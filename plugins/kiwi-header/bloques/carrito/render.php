<?php
/**
 * Render del bloque kiwi/carrito.
 *
 * El conteo sale del servidor: si el script de actualización falla, el número
 * que se ve sigue siendo correcto para la página cargada.
 *
 * @var array    $attributes
 * @var string   $content
 * @var WP_Block $block
 */

defined( 'ABSPATH' ) || exit;

$kiwi_cuenta = ( function_exists( 'WC' ) && WC()->cart ) ? (int) WC()->cart->get_cart_contents_count() : 0;
$kiwi_url    = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : home_url( '/' );

/* translators: %d: número de piezas en el carrito. */
$kiwi_una = __( 'Carrito, %d pieza', 'kiwi-header' );
/* translators: %d: número de piezas en el carrito. */
$kiwi_varias = __( 'Carrito, %d piezas', 'kiwi-header' );

$kiwi_etiqueta = sprintf(
	/* translators: %d: número de piezas en el carrito. */
	_n( 'Carrito, %d pieza', 'Carrito, %d piezas', $kiwi_cuenta, 'kiwi-header' ),
	$kiwi_cuenta
);

$kiwi_envoltura = get_block_wrapper_attributes(
	array(
		'class'      => 'kiwi-carrito',
		'aria-label' => $kiwi_etiqueta,
	)
);
?>
<a
	<?php echo $kiwi_envoltura; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	href="<?php echo esc_url( $kiwi_url ); ?>"
	data-kiwi-api="<?php echo esc_url( rest_url( 'wc/store/v1/cart' ) ); ?>"
	data-kiwi-una="<?php echo esc_attr( $kiwi_una ); ?>"
	data-kiwi-varias="<?php echo esc_attr( $kiwi_varias ); ?>"
>
	<span class="kiwi-carrito__icono">
		<?php echo kiwi_header_icono( 'carrito' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<span class="kiwi-carrito__badge" aria-hidden="true"<?php echo $kiwi_cuenta > 0 ? '' : ' hidden'; ?>><?php echo esc_html( (string) $kiwi_cuenta ); ?></span>
	</span>
</a>
