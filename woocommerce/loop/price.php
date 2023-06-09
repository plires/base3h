<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
	<span class="price"><?php echo $price_html; ?></span>

	<!-- Agregado Cuotas sin interes en el loop de productos -->
	<?php
	
		$product_data = accessProtected($product, 'data');
		$cuota = floatval($product_data['price'] / CUOTAS_SIN_INTERES);
		$price_formated = number_format( $cuota,0,",","." );
	
	?>

	<span style="font-size: 0.8751rem; margin-top: -10px; margin-bottom: 15px; display: block;"><?= CUOTAS_SIN_INTERES ?> cuotas <span style="font-weight: 700; color: #444;">SIN INTERÉS</span> de <span style="font-weight: 700; color: #444;"> <?= "$" . $price_formated ?></span></span>

	<?php endif; ?>
	<!-- Agregado Cuotas sin interes en el loop de productos end -->