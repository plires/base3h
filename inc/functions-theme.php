<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	function sendEmail($destinatario, $template, $post, $url, $method = NULL) {

		$email_data = setEmailConfiguration($destinatario, $post);

		$subject_and_content = setEmailTemplateAndSubject($template, $post);

		$mail = new PHPMailer(true);

		try {
	    //Server settings
	    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
      // $mail->SMTPDebug = 2; //Alternative to above constant
	    $mail->isSMTP();                                            //Send using SMTP
	    $mail->Host       = SMTP;                     //Set the SMTP server to send through
	    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	    $mail->Username   = SMTP_USER;                     //SMTP username
	    $mail->Password   = SMTP_PASS;                               //SMTP password
	    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = EMAIL_PORT;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    $mail->CharSet = EMAIL_CHARSET;

	    $mail->SMTPOptions = array(
        'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
        )
      );

	    //Recipients
	    $mail->setFrom($email_data['email_show'], $email_data['name_show']);
	    $mail->addAddress($email_data['destino']);
	    $mail->AddReplyTo($email_data['email_add_reply_to']);

	    //Content
	    $mail->isHTML(true);                                  //Set email format to HTML
	    $mail->Subject = $subject_and_content['subject'];
	    $mail->Body    = $subject_and_content['content'];

	    $mail->send();
		} catch (Exception $e) {

			if ($method === 'ajax') {
				/* Retornar mensaje de error.	*/
				$response_array['status'] = false;
				$response_array['msg'] = 'Error al enviar el mail. Intente mas tarde por favor.';
	      echo json_encode($response_array); exit;
			}

			$newsletter = stripos($template , 'newsletter');

			if ($newsletter === false) {

				// Enviamos al usuario a la misma página con una variable GET de error y las variables form para mantener los valores ingresados
				// por el usuario al momento de enviar el formulario.
				wp_redirect( add_query_arg( array( 
					'form["name"]' => $post['name'] ,
					'form["lastname"]' => $post['lastname'] ,
					'form["email"]' => $post['email'] ,
					'form["phone"]' => $post['phone'] ,
					'form["comments"]' => $post['comments'] ,
					'errors_contact["email"]' => 'No se pudo enviar el email'
				), $url . '#contacto') );
				exit;
			} else {
				wp_redirect( add_query_arg( array( 'errors' => "No se pudo enviar el mail" ), $url . '#newsletter') );
				exit;
			}
		}
	}

	function setEmailTemplateAndSubject($template, $post) {

		$email_data = [];
		
		switch ($template) {


      case 'Newsletter Cliente':

        include('email-templates/newsletter-to-client.php'); 
        $subject = 'Nueva Suscripcion a Newsletter Base3 Home.';
        break;
      
      case 'Newsletter Usuario':
        include('email-templates/newsletter-to-user.php'); 
        $subject = 'Gracias por tu contacto.';
        break;

      case 'Contacto Cliente':

        include('email-templates/contacto-to-client.php'); 
        $subject = 'Nuevo contacto Base3 Home.';
        break;
      
      case 'Contacto Usuario':
        include('email-templates/contacto-to-user.php'); 
        $subject = 'Gracias por tu contacto.';
        break;
    }

    $email_data['subject'] = $subject;
    $email_data['content'] = $content;

    return $email_data;

	}

	function setEmailConfiguration($destinatario, $post) {

		$email = [];

		switch ($destinatario) {
      case 'Cliente':
        $emailDestino = EMAIL_TIENDA;

        if (isset($post['name'])) {
          $nameShow = $post['name'];
          $emailAddReplyTo = $post['email'];
        } else {
          $nameShow = $post['email'];
          $emailAddReplyTo = $post['email'];
        }
        $emailShow = $post['email'];  
        break;
      
      case 'Usuario':
        $emailDestino = $post['email'];
        $nameShow = EMAIL_NAME;
        $emailShow = EMAIL_TIENDA;  // Mi cuenta de correo
        $emailAddReplyTo = EMAIL_TIENDA;
        break;
    }

    $email['destino'] = $emailDestino;
    $email['name_show'] = $nameShow;
    $email['email_show'] = $emailShow;
    $email['email_add_reply_to'] = $emailAddReplyTo;

    return $email;

	}

	function AddEmailToPerfit($origin, $email) {

		$perfit = new PerfitSDK\Perfit( ['apiKey' => PERFIT_APY_KEY_B3H ] );
		$listId = PERFIT_LIST_B3H;

		if (!isset($name)) {
		  $name = '';
		}

		if (!isset($origin)) {
		  $origin = 'Ecommerce';
		}

		if (!isset($phone)) {
		  $phone = '-';
		}

		$userPerfit = $perfit->get('/lists/' .$listId. '/contacts' .$email); // BUSCAR usuario

		if (!$userPerfit->success) { // Si no se encuentra en la base de datos cargarlo
		  $response = $perfit->post('/lists/' .$listId. '/contacts', 
		    [
		      'firstName' => $name, 
		      'email' => $email,
		      'customFields' => 
		        [
		          [
		            'id' => 10, 
		            'value' => $origin
		          ],
		          [
		            'id' => 11, 
		            'value' => $phone
		          ]
		        ]
		    ]
		  );
		}

	}

	function searchEmailInBDD($wpdb, $tablename, $email) {

		$results = $wpdb->get_results("SELECT email FROM $tablename ", ARRAY_A);

		// Convierto de array multidimensional a array
		$array = array_column($results, 'email');

		// Buscamos el email
		$email_found = in_array($email, $array);

		return $email_found;

	}

	function saveNewsletterInDatabase($wpdb, $post, $url){

		//seteamos la tabla
		$tablename = $wpdb->prefix . "newsletters";

		// SIEMPRE SE DEBEN SANITIZAR LOS VALORES
		$email = sanitize_text_field( $post['email'] );
		$created_at = date("Y-m-d H:i:s");
		
		/* Grabar el registro en base de datos */
		$sql = "INSERT INTO $tablename (email, created_at) VALUES (%s, %s)";
		
		$prepare_query = $wpdb->prepare( $sql, $email, $created_at );
		$record_saved = $wpdb->query($prepare_query);

		return $record_saved;
			
	}

	function checkTheFormNewsletter($post, $url) {

		if( 
			empty( $post['email'] ) || 
			!is_email( $post['email'] ) ||
			!wp_verify_nonce($post['newsletter_nonce'], 'graba_newsletter')
		):
			return false;
		else:
			return true;
		endif;

	}

	function saveContactInDatabase($wpdb, $post, $url){
		
		//seteamos la tabla
		$tablename = $wpdb->prefix . "contacts";

		// SIEMPRE SE DEBEN SANITIZAR LOS VALORES
		$name = sanitize_text_field( $post['name'] );
		$lastname = sanitize_text_field( isset($post['lastname']) );
		$email = sanitize_text_field( $post['email'] );
		$phone = sanitize_text_field( $post['phone'] );
		$comments = sanitize_text_field( $post['comments'] );
		$created_at = date("Y-m-d H:i:s");

		/* Grabar el registro en base de datos */
		$sql = "INSERT INTO $tablename (name, lastname, email, phone, comments, created_at) VALUES (%s, %s, %s, %s, %s, %s)";

		$prepare_query = $wpdb->prepare( $sql, $name, $lastname, $email, $phone, $comments, $created_at );
		$record_saved = $wpdb->query($prepare_query);

		return $record_saved;

	}

	function checkFormContact($post, $url) {

		$errors_contact = [];
		$name = '';
		$lastname = '';
		$email = '';
		$phone = '';
		$comments = '';

		if ( !wp_verify_nonce($post['contacto_nonce'], 'graba_contacto') ) {
			$errors_contact['nonce'] = 'Error al procesar, vuelva a intentarlo';
		}

		if ( empty($post['name']) ) {
			$errors_contact['name'] = 'Por favor ingresá tu nombre';
		} else {
			$name = $post['name'];
		}

		if ( isset($post['lastname']) ) {
			$lastname = $post['lastname'];
		}

		if ( empty($post['email']) || !is_email($post['email']) ) {
			$errors_contact['email'] = 'Por favor ingresá un email válido';
		} else {
			$email = $post['email'];
		}

		if ( empty($post['phone']) ) {
			$errors_contact['phone'] = 'Por favor ingresá un teléfono de contacto';
		} else {
			$phone = $post['phone'];
		}

		if ( empty($post['comments']) ) {
			$errors_contact['comments'] = 'Por favor ingresá tu mensaje';
		} else {
			$comments = $post['comments'];
		}


		if ($errors_contact) {
			return $errors_contact;
		} else {
			return false;
		}

	}

	// Funcion para cambiar el logo en la barra superior del backend
	function jc_change_icon_admin_bar() {

		$image = esc_url( get_stylesheet_directory_uri() ) . '/img/backend/logo-barra.png';
	
		echo '<style type="text/css">
		
				#wpadminbar #wp-admin-bar-wp-logo > .ab-item .ab-icon:before {
					background-image: url('. $image .')!important;
					background-size: cover;
					background-position: 0 0;
					color:rgba(0, 0, 0, 0);
				}
				
				#wpadminbar #wp-admin-bar-wp-logo.hover > .ab-item .ab-icon {
					background-position: 0 0;
				}
		</style>';
	}

	add_action('wp_before_admin_bar_render', 'jc_change_icon_admin_bar');

	//Cambiamos el logo del admin login
	add_action( 'login_enqueue_scripts', 'bs_change_login_logo' );
	function bs_change_login_logo() {

		$image = esc_url( get_stylesheet_directory_uri() ) . '/img/backend/logo-login.png';

	?>

	<style type="text/css"> 
	  
	#login h1 a {
		background-image: url('<?= $image ?>');
		pointer-events:none;
	} 
						  
	</style>
						  
	<?php }

	//Cambiamos la URL del logo			  
	add_filter( 'login_headerurl', 'bs_login_logo_url' );
		function bs_login_logo_url($url) {
    return '#';
  }

  // Cambiar Favicon Admin
  function faviconAdmin() {

  	$image = esc_url( get_stylesheet_directory_uri() ) . '/img/backend/favicon.png';
  
	 echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('wpurl') . '/wp-content/themes/porto-child/img/backend/favicon.png" />';
	}
	 
	// Agrega las miniaturas de las imagenes del producto a la plantilla de email de pedidos
	add_action( 'admin_head', 'faviconAdmin' );

	function dpw_add_images_woocommerce_emails( $output, $order ) {
 
	 static $run = 0;
	 
	 if ( $run ) {
	 return $output;
	 }
	 
	 $args = array(
	 'show_image' => true,
	 'image_size' => array( 80, 80 ),
	 );
	 
	 $run++;
	 
	 return wc_get_email_order_items( $order, $args );
	}
	add_filter( 'woocommerce_email_order_items_table', 'dpw_add_images_woocommerce_emails', 10, 2 );

	// Modo mantenimiento
	function mode_maintenance(){
	    if(!current_user_can('edit_themes') || !is_user_logged_in()){
	        wp_die('<div style="border:dotted 3px black;"><h1 style="color:#77d6b7; text-align:center; font-size:35px;">SITIO WEB EN MANTENIMIENTO</h1><p style="text-align:center; font-size:30px;">Disculpá las molestias, Estamos realizando tareas de mantenimiento, por favor intentá mas tarde.</p>
	        	<p style="text-align:center; font-size:30px;"><strong>Gracias!</strong></p><center></center></div>', 'Sitio en Mantenimiento', array( 'response' => 503 )); 
	    }
	}
	//add_action('init', 'mode_maintenance'); // ACTIVAR ESTA LINEA PARA EL MODO MANTENIMIENTO DE ARCHIVOS

?>