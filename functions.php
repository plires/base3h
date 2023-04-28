<?php

	require_once __DIR__ . "/vendor/autoload.php";

	// Requires
  require_once('inc/config.php');
	require_once('inc/get_styles_and_js.php');
	require_once('inc/functions-theme.php');
	require_once('php/formulario-newsletter.php');
	require_once('php/formulario-newsletter-pop-up.php');
	require_once('php/formulario-contacto.php');

	/**
	 * Remove product data tabs
	 */
	add_filter( 'woocommerce_product_tabs', '__return_empty_array', 98 );

	// Quitar el rango de precios de los productos variables en woocommerce
	function get_min_price( $price, $product ) {

		// Sale price min and max
		$min_sale_price = $product->get_variation_sale_price( 'min' );

		// return sprintf( __( 'Desde: %1$s', 'woocommerce' ), '$' . number_format($min_sale_price ), 0 , ",", ",", ".");
		return sprintf( __( '<span class="woocommerce-Price-amount amount precio_desde">Desde:  %1$s</span>', 'woocommerce' ), '$' . number_format ( $min_sale_price , 0 , ',' , '.' ));

	}
	 
	add_filter( 'woocommerce_variable_sale_price_html', 'get_min_price', 10, 2 );
	add_filter( 'woocommerce_variable_price_html', 'get_min_price', 10, 2 );

	/* Funcion para poder acceder a propiedades protegidas de objetos
	// - Recibe el objeto y la propiedad
	// - Devuelve la propiedad en un array
	*/
	function accessProtected($obj, $prop) {
	  $reflection = new ReflectionClass($obj);
	  $property = $reflection->getProperty($prop);
	  $property->setAccessible(true);
	  return $property->getValue($obj);
	}

// 	function footer_enqueue_scripts() {

// 	remove_action('wp_head', 'gtm4wp_woocommerce_enqueue_scripts');
// 	add_action('wp_footer', 'gtm4wp_woocommerce_enqueue_scripts', 5);

// }

// add_action('after_setup_theme', 'footer_enqueue_scripts');

// Refrescar metodo de pago al cambiar el input en el chekout
function refresh_checkout_on_payment_methods_change(){
    ?>
    <script type="text/javascript">
        (function($){
            $( 'form.checkout' ).on( 'change', 'input[name^="payment_method"]', function() { 
                $('body').trigger('update_checkout');
            });
        })(jQuery);
    </script>
    <?php
}

add_action( 'woocommerce_review_order_before_payment', 'refresh_checkout_on_payment_methods_change' );

// Hook en pagina de producto para agregar cuotas sin interes.
function base3h_woocommerce_single_product_summary() { 
	global $product;
	
	$product_data = accessProtected($product, 'data');
	$cuota = floatval($product_data['price'] / CUOTAS_SIN_INTERES);
	$cuota_formated = number_format( $cuota,2,",","." );

	include('template-parts/cuotas-sin-interes.php');
}; 
         
// add the action 
add_action( 'woocommerce_single_product_summary', 'base3h_woocommerce_single_product_summary', 10, 2 );

/**
 * Remover posicion de la descripción original
 */ 
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

?>