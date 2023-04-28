<?php

/**
 * Función para capturar los valores del
 * formulario de Contacto del website.
 *
 * Los datos son enviados por email a la tienda
 */
function procesar_formulario_contacto() {

	global $wpdb;
	$url = $_SERVER['HTTP_REFERER'];
	$actual_url = explode("?", $url);
	$origin = 'Ecommerce - ' . $actual_url[0];

	// Verificamos los inputs
	$errors_contact = checkFormContact($_POST, $actual_url[0]);

	if (!$errors_contact) {

		/* Verificar si el email se encuentra en la tabla */
		// $email_not_found_in_database = searchEmailInBDD($wpdb, 'lc_contacts', $_POST['email']);

		// if (!$email_not_found_in_database) {
		// 	AddEmailToPerfit($origin, $_POST['email']); // Alta en Sistema Perfit
		// }
		
		saveContactInDatabase($wpdb, $_POST, $actual_url[0]); // Salvamos el registro en la tabla

		sendEmail('Cliente', 'Contacto Cliente', $_POST, $actual_url[0]); // Enviar email Cliente
		sendEmail('Usuario', 'Contacto Usuario', $_POST, $actual_url[0]); // Enviar email Usuario

		/* Redireccionar al usuario a la misma u a otra nueva página con una variable de éxito.	*/
		wp_redirect( $actual_url[0] . '?exito_form_contacto=1' . '#contacto'); exit;
		
	} else {

		// Enviamos al usuario a la misma página con una variable GET de error y las variables form para mantener los valores ingresados
		// por el usuario al momento de enviar el formulario.
		wp_redirect( add_query_arg( array( 
			'form["name"]' => $_POST['name'] ,
			'form["lastname"]' => $_POST['lastname'] ,
			'form["email"]' => $_POST['email'] ,
			'form["phone"]' => $_POST['phone'] ,
			'form["comments"]' => $_POST['comments'] ,
			'errors_contact["name"]' => $errors_contact['name'] ,
			'errors_contact["email"]' => $errors_contact['email'],
			'errors_contact["phone"]' => $errors_contact['phone'],
			'errors_contact["comments"]' => $errors_contact['comments']
		), $actual_url[0] . '#contacto') );
		exit;

	}

}

add_action('admin_post_nopriv_contacto', 'procesar_formulario_contacto');
add_action('admin_post_contacto', 'procesar_formulario_contacto');