    <?php
    /*
    * template name: Contato
    */
    require_once 'header.php';
    require_once 'includes/title.php';
    ?>

	<!-- Google map
	<div class="map" id="map-area"></div>-->


	<!-- Contact section -->
	<div class="contact-section spad fix">
		<div class="container">
			<div class="row">
				<!-- contact info -->
				<div class="col-md-5 col-md-offset-1 contact-info col-push">
					<div class="section-title left">
						<h2>Contate-nos</h2>
					</div>
                    <?php
                    the_post();

                    the_content();

                    ?>

					<h3 class="mt60">Nosso endereço</h3>
					<p class="con-item"><?php the_field('endereco'); ?></p>
					<p class="con-item"><?php the_field('telefone'); ?></p>
					<p class="con-item"><?php the_field('email'); ?></p>
				</div>
				<!-- contact form -->
				<div class="col-md-6 col-pull">

                    <?php echo do_shortcode( '[contact-form-7 id="61" title="Meu formulário de contato"  html_id="con_form" html_class="form-class"]' ); ?>

				</div>
			</div>
		</div>
	</div>
	<!-- Contact section end-->


    <?php require_once 'footer.php'; ?>

