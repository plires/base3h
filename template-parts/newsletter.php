<section id="newsletter" class="newsletter container text-center">
	<div class="row">
		<div class="col-sm-12">
			<p>¿Querés enterarte las últimas novedades y ofertas antes que nadie?</p>

			<?php if (isset($_GET['errors'])): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <?= $_GET['errors']; ?>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php endif ?>

			<?php if (isset($_GET['exito'])): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  Suscripción <strong>exitosa!</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			<?php endif ?>

			<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="needs-validation form-inline" novalidate>

				<?php wp_nonce_field('graba_newsletter', 'newsletter_nonce'); ?>

			  <div class="input-group">
			    <input required type="email" class="form-control" name="email" value="<?php echo ( isset($_GET['email']) ? $_GET['email'] : '' ); ?>" placeholder="juan@gmail.com">
			    <div class="invalid-feedback">
		        Por favor ingresá tu email
		      </div>
			  </div>

			  <input type="hidden" name="action" value="newsletter">
			  <input type="hidden" id="g-recaptcha-response-newsletter" name="g-recaptcha-response-newsletter">

			  <button type="submit" class="btn btn-primary transition">Enviar</button>
			</form>
		</div>
	</div>
</section>