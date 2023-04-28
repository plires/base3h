<section id="pop_up" class="pop_up">
	<div id="content_pop_up" class="content no_close">

		<button id="btn_close" type="button" class="close" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>

		<div class="image no_close">
			<img class="img-fluid logo_pop_up no_close" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/pop-up/logo.png'; ?>" alt="logo base3home">
			<img id="image_pop_up" class="img-fluid no_close" src="#" alt="mesa roma">
		</div>

		<div class="news no_close">

			<h2 class="no_close">¡No te quedes afuera!</h2>
			<p class="no_close">Suscribite a nuestro newsletter y recibí todas las novedades y ofertas</p>

			<form id="form_pop_up" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="no_close needs-validation" novalidate>

				<?php wp_nonce_field('graba_newsletter', 'newsletter_nonce'); ?>

			  <div class="no_close input-group">
			    <input required type="email" class="form-control no_close" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo ( isset($_GET['email']) ? $_GET['email'] : '' ); ?>" placeholder="ingresá tu email">
			    <div class="invalid-feedback no_close">
		        Por favor ingresá tu email
		      </div>
			  </div>

			  <input class="no_close" type="hidden" name="action" value="newsletter_pop_up">

			  <button type="submit" class="btn btn-primary no_close transition">SUSCRIBIRME</button>

			  <div id="spinner" class="content_spinner no_close"><div class="spinner no_close"></div></div>

			</form>

			<p class="no_close" id="popup_response"></p>

		</div>
	</div>	
</section>