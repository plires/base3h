<?php get_header(); ?>

<?php
	$name = isset($_GET['form']['name']) ? $_GET['form']['name'] : '';
	$lastname = isset($_GET['form']['lastname']) ? $_GET['form']['lastname'] : '';
	$email = isset($_GET['form']['email']) ? $_GET['form']['email'] : '';
	$phone = isset($_GET['form']['phone']) ? $_GET['form']['phone'] : '';
	$comments = isset($_GET['form']['comments']) ? $_GET['form']['comments'] : '';
?>

<!-- Contacto -->
<section id="contacto" class="base3h_contacto">

	<div class="container">

		<div class="row">
			<div class="col-md-8 offset-md-2 text-center">

				<img class="logo_base3h img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/contacto/logo-b3h.gif'; ?>" alt="logo bh3 contacto">

				<p class="copete">
					Comenzamos a diseñar, fabricar y vender productos de decoración pensando en ayudar a <span>crear espacios personales</span> y nos enorgullecemos del diseño experto y el servicio que podemos brindar a nuestros clientes.
				</p>

				<h1>CONTACTO</h1>

				<p class="consultas">Envianos tus dudas, consultas y/o sugerencias o llamanos al +5411 4909-9999</p>

			</div>	
		</div>

		<div class="row form">
			<div class="col-md-8 offset-md-2">

				<?php if (isset($_GET['errors_contact'])): ?>

					<div style="width: 100%;" class="alert alert-danger alert-dismissible fade show" role="alert">
					  <ul>
								
							<?php foreach ($_GET["errors_contact"] as $error): ?>
								<li><?= $error; ?></li>
							<?php endforeach ?>
							 
						</ul>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>

				<?php endif ?>

				<?php if (isset($_GET['exito_form_contacto'])): ?>
					<div style="width: 100%;" class="alert alert-success alert-dismissible fade show" role="alert">
					  Formulario enviado con éxito!
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
				<?php endif ?>

				<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" class="needs-validation" novalidate>

					<?php wp_nonce_field('graba_contacto', 'contacto_nonce'); ?>

				  <div class="form-row row">

				  	<!-- Nombre -->
				    <div class="form-group col-md-6">
				      <input required type="text" class="form-control" name="name" value="<?= $name ?>" placeholder="Nombre *">
				      <div class="invalid-feedback">
				        Ingresá tu nombre
				      </div>
				    </div>
				  	<!-- Nombre end -->

				    <!-- Apellido -->
				    <div class="form-group col-md-6">
				      <input type="text" class="form-control" name="lastname" value="<?= $lastname ?>" placeholder="Apellido">
				    </div>
				  	<!-- Apellido end -->

				  </div>

				  <div class="form-row row">

				  	<!-- Email -->
				    <div class="form-group col-md-6">
				      <input required type="email" class="form-control" name="email" value="<?= $email ?>" placeholder="Email *">
				      <div class="invalid-feedback">
				        Ingresá tu email
				      </div>
				    </div>
				  	<!-- Email end -->

				    <!-- Teléfono -->
				    <div class="form-group col-md-6">
				      <input required type="text" class="form-control" name="phone" value="<?= $phone ?>" placeholder="Teléfono *">
				      <div class="invalid-feedback">
				        Ingresá tu teléfono
				      </div>
				    </div>
				  	<!-- Teléfono end -->

				  </div>

				  <div class="form-row row">

				  	<!-- Comentarios -->
				    <div class="form-group col-md-12">
				    	<textarea required class="form-control" name="comments" rows="4" placeholder="Mensaje *"><?= $comments ?></textarea>
				      <div class="invalid-feedback">
				        Ingresá tu Comentarios
				      </div>
				    </div>
				  	<!-- Comentarios end -->

				  </div>

				  <input type="hidden" name="action" value="contacto">

				  <div class="text-center">
			    	<input class="send transition" type="submit" value="Enviar">
				  </div>

				</form>

			</div>
		</div>
	</div>	

	<!-- Newsletter -->
	<?php include('template-parts/newsletter.php'); ?>
	<!-- Newsletter end -->

	<!-- Shake -->
	<div class="text-center">
		<img class="rock_house img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/contacto/shake.gif'; ?>" alt="shake you house">
	</div>
	<!-- Shake end -->

	<!-- Ultimos Productos -->
	<section class="ultimos_productos container">
		<div class="row">
			<div class="col-sm-12">
				<h2>LO ÚLTIMO</h2>
				<?php echo do_shortcode( ' [porto_products view="products-slider" orderby="date"] ' ); ?>
			</div>
		</div>
	</section>
	<!-- Ultimos Productos end -->

</section>
<!-- Contacto end -->


<?php get_footer(); ?>