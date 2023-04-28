<?php

/**
 * Función para capturar los valores del
 * formulario de newsletter del website.
 *
 * Los datos son enviados por email a la tienda
 */
function procesar_formulario_newsletter_pop_up() {

	global $wpdb;
	$url = $_SERVER['HTTP_REFERER'];
	$actual_url = explode("?", $url);
	$origin = 'Newsletter Pop Up - ' . $actual_url[0];

	$validRecaptcha = validarRecaptcha($_POST['g-recaptcha-response-pop']);

	// Verificamos el campo
	$checked_input = checkTheFormNewsletter($_POST, $actual_url[0]);

	if ($checked_input && $validRecaptcha) {

		/* Verificar si el email se encuentra en la tabla */
		$email_not_found_in_database = searchEmailInBDD($wpdb, 'lc_newsletters', $_POST['email']);

		if (!$email_not_found_in_database) {

			saveNewsletterInDatabase($wpdb, $_POST, $actual_url[0]); // Salvamos el registro en la tabla

			// AddEmailToPerfit($origin, $_POST['email']); // Alta en Sistema Perfit

			sendEmail('Cliente', 'Newsletter Cliente', $_POST, $actual_url[0], 'ajax'); // Enviar email Cliente
			sendEmail('Usuario', 'Newsletter Usuario', $_POST, $actual_url[0], 'ajax'); // Enviar email Usuario

			/* Retornar mensaje de exito.	*/
			$response_array['status'] = true;
			$response_array['msg'] = 'Gracias por suscribirse';
      echo json_encode($response_array); exit;

		} else {

			/* Retornar mensaje de error.	*/
			$response_array['status'] = false;
			$response_array['msg'] = 'El correo ya esta ingresado en nuestra lista.';
      echo json_encode($response_array); exit;

		}
		
	} else {

		/* Retornar mensaje de error.	*/
		$response_array['status'] = false;
		$response_array['msg'] = 'Por favor ingrese un email válido';
    echo json_encode($response_array); exit;

	}
	
}

add_action('admin_post_nopriv_newsletter_pop_up', 'procesar_formulario_newsletter_pop_up');
add_action('admin_post_newsletter_pop_up', 'procesar_formulario_newsletter_pop_up');