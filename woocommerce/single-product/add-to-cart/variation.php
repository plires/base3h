<?php
/**
 * Single variation display
 *
 * This is a javascript-based template for single variations (see https://codex.wordpress.org/Javascript_Reference/wp.template).
 * The values will be dynamically replaced after selecting attributes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.5.0
 */

defined( 'ABSPATH' ) || exit;

/* Agregado para cuotas sin interes */
echo "
<script>
	var cuotasPHP = ".CUOTAS_SIN_INTERES."

	function currencyFormatDE(num, decimals) {
	  return (
	    num
	      .toFixed(decimals) // always two decimal digits
	      .replace('.', ',') // replace decimal point character with ,
	      .replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
	  ) // use . as a separator
	}

</script>
";
/* Agregado para cuotas sin interes end */

?>
<script type="text/template" id="tmpl-variation-template">

	<# let cuotas = data.variation.display_price / cuotasPHP #>
	<# let cuotas_html = currencyFormatDE(cuotas, 2) #>

	<# 	if (data.variation.price_html == '') {
				let price_html = currencyFormatDE(data.variation.display_price, 0)
				data.variation.price_html = '<div class="woocommerce-variation-price"> <span class="price"> <span class="woocommerce-Price-amount amount"> <bdi> <span class="woocommerce-Price-currencySymbol">$</span>'+price_html+'</bdi> </span> </span></div>'
			}
	#>

	<div class="woocommerce-variation-description">{{{ data.variation.variation_description }}}</div>
	<div class="woocommerce-variation-price">{{{ data.variation.price_html }}}</div>

	<section class="cuotas">
		<div class="content text-center">

			<p class="detalle_cuotas"><?= CUOTAS_SIN_INTERES ?> X ${{{ cuotas_html }}}</p>
			<p class="frase_final">cuotas sin interes</p>

		</div>
	</section>

	<div class="woocommerce-variation-availability">{{{ data.variation.availability_html }}}</div>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
	<p><?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></p>
</script>
