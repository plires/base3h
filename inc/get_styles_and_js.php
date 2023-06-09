<?php
	add_action( 'wp_enqueue_scripts', 'porto_child_css', 1001 );

	// Load CSS
	function porto_child_css() {
		// porto child theme styles
		wp_deregister_style( 'styles-child' );
		wp_register_style( 'styles-child', esc_url( get_stylesheet_directory_uri() ) . '/style.css' );
		wp_enqueue_style( 'styles-child' );
		wp_enqueue_script('recaptcha', 'https://www.google.com/recaptcha/api.js?render=' . RECAPTCHA_KEY_SITE);
		wp_enqueue_script( 'scripts-validate-forms', get_stylesheet_directory_uri() . '/js/validate-forms.js' );

		if (is_front_page()) {
			wp_enqueue_script( 'pop-up', get_stylesheet_directory_uri() . '/js/pop-up.js' );
			wp_enqueue_script( 'recaptcha-newsletter', get_stylesheet_directory_uri() . '/js/recaptcha-form-newsletter.js' );
		}

		if (is_page('contacto')) {
			wp_enqueue_script( 'recaptcha-newsletter', get_stylesheet_directory_uri() . '/js/recaptcha-form-contacto.js' );
    }

		if ( is_rtl() ) {
			wp_deregister_style( 'styles-child-rtl' );
			wp_register_style( 'styles-child-rtl', esc_url( get_stylesheet_directory_uri() ) . '/style_rtl.css' );
			wp_enqueue_style( 'styles-child-rtl' );
		}
	}

	?>