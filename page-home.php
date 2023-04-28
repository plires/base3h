<?php get_header(); ?>

<!-- Pop Up -->
<div id="pop_up_overlay"></div>
<?php include('template-parts/pop-up-newsletter.php'); ?>

<!-- Home -->
<section class="base3h_home">

	<!-- Slide -->
	<section style="margin-bottom: 30px;" class="slide_home container-fluid p-0">
		<div class="row">
			<div class="col-sm-12 p-0">
				<div id="carouselCaptions" class="carousel slide" data-ride="carousel">
				  <ol class="carousel-indicators">
				    <li data-target="#carouselCaptions" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselCaptions" data-slide-to="1"></li>
				    <li data-target="#carouselCaptions" data-slide-to="2"></li>
				  </ol>
				  <div class="carousel-inner">

				  	<div class="carousel-item active">
							<img id="slide_2" src="#" alt="slide descuento desktop">
						  <div class="slide_2 carousel-caption">
								<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/slide/slide-front-2.png'; ?>" alt="palabra descuento desktop">
						  </div>
						</div>

				    <div class="carousel-item">
							<img id="slide_3" src="#" alt="slide mesas desktop">
						  <div class="slide_3 carousel-caption">
								<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/slide/slide-front-3.png'; ?>" alt="palabra mesas desktop">
						    <p>
						    	Pensadas para apoyar todo lo que te imagínes... Whisky, café o un simple té de jengibre y limón, pero con elegancia.
						  	</p>
						  	<a href="<?php echo esc_url( get_category_link( 120 ) ); ?>" class="btn btn-primary transition">ver más</a>
						  </div>
						</div>

						<div class="carousel-item">
							<img id="slide_1" src="#" alt="slide objetos desktop">
						  <div class="slide_1 carousel-caption">
						    <p>
						    	Si fueran sólo cuadros y espejos no los encontrarías acá. Encontrá estilo, personalidad y arte hechos objetos.
						  	</p>
								<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/slide/slide-front-1.png'; ?>" alt="palabra objetos desktop">
						  	<a href="<?php echo esc_url( get_category_link( 122 ) ); ?>" class="btn btn-primary transition">ver más</a>
						  </div>
						</div>

				  </div>
				  <a class="carousel-control-prev" href="#carouselCaptions" role="button" data-slide="prev">
				    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselCaptions" role="button" data-slide="next">
				    <span class="carousel-control-next-icon" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
			</div>
		</div>
	</section>
	<!-- Slide end -->

	<!-- Productos -->
	<section class="productos container">
		<div class="row">
			<div class="col-sm-12">
				<h2>LOS MÁS VISTOS</h2>
				<?php echo do_shortcode( ' [porto_products view="products-slider"] ' ); ?>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ) ;?>" class="btn btn-primary transition">ver todos los productos</a>
			</div>
		</div>
	</section>
	<!-- Productos end -->

	<!-- Categorias -->
	<section class="categorias container-fluid p-0">
		<div class="row">
			<div class="col-md-6 p-0">
				<h2>OBJETOS</h2>
				<a href="<?php echo esc_url( get_category_link( 122 ) ); ?>">
					<img class="img-fluid transition" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/espejos.jpg'; ?>" alt="espejos">
				</a>
			</div>
			<div class="col-md-6 p-0">
				<h2>MESAS</h2>
				<a href="<?php echo esc_url( get_category_link( 120 ) ); ?>">
					<img class="img-fluid transition" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/mesas.jpg'; ?>" alt="mesas">
				</a>
			</div>
		</div>
	</section>
	<!-- Categorias end -->

	<!-- Bullets -->
	<section class="bullets container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-6 col-md-3">
					<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/10-off.png'; ?>" alt="descuento 10% off">
					<h3>10% OFF CON<br><span>TRANSFERENCIA</span></h3>
				</div>
				<div class="col-6 col-md-3">
					<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/ahora-12.png'; ?>" alt="ahora 12">
					<h3>AHORA 12<br><span>CUOTAS FIJAS EN PESOS</span></h3>
				</div>
				<div class="col-6 col-md-3">
					<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/envios.png'; ?>" alt="envios a todo el pais">
					<h3>ENVIOS<br><span>A TODO EL PAÍS</span></h3>
				</div>
				<div class="col-6 col-md-3">
					<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/pick-up.png'; ?>" alt="pick up retiro gratis">
					<h3>PICK UP<br><span>RETIRALO GRATIS</span></h3>
				</div>
			</div>
		</div>
	</section>
	<!-- Bullets end -->

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

	<!-- Newsletter -->
	<?php include('template-parts/newsletter.php'); ?>
	<!-- Newsletter end -->

	<!-- Frase -->
	<section class="frase container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/frase-mesa.png'; ?>" alt="envios a todo el pais">
					<div>
						<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/logo-base3-home.png'; ?>" alt="logo base3 home">
						<p>FABRICAMOS SERIES LIMITADAS Y PERSONALIZADAS <span>DIFERENTES... COMO VOS</span></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Frase end -->

	<!-- Instagram -->
	<section class="instagram container">
		<div class="row">
			<div class="col-sm-12">
				<div class="titulos">
					<img class="img-fluid" src="<?= esc_url( get_stylesheet_directory_uri() ) . '/img/home/logo-instagram.png'; ?>" alt="logo instagram">
					<h2>@base3home</h2>
				</div>
				<div class="mb-5" data-mc-src="53df5897-ebab-4a56-843f-4021b6e671f6#instagram"></div>
        
				<script 
				  src="https://cdn2.woxo.tech/a.js#60086395af9cf10015587582" 
				  async data-usrc>
				</script>
				<h2>¡SEGUINOS!</h2>
			</div>
		</div>
	</section>
	<!-- Instagram end -->

</section>
<!-- Home end -->

<?php get_footer(); ?>