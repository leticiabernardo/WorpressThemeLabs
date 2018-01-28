<?php
/*
 * template name: Início
 */

require_once 'header.php';

?>

	<!-- Intro Section -->
	<div class="hero-section">

		<!-- slider -->
		<div id="hero-slider" class="owl-carousel">
            <?php query_posts('post_type=slide'); ?>

                <?php if(have_posts('slide')): while(have_posts()): the_post(); ?>
                    <div class="item  hero-item" data-bg="<?php the_field('imagem'); ?>"></div>

                <?php endwhile; ?>
                <?php endif; ?>

            <?php wp_reset_query(); ?>
		</div>
	</div>
	<!-- Intro Section -->


	<!-- About section -->
	<div class="about-section">
		<div class="overlay"></div>
		<!-- card section -->
		<div class="card-section">
			<div class="container">
				<div class="row">
                    <?php
                    $args = array(
                        'post_type' => 'servicos',
                        'posts_per_page' => 3,
                    );

                    $novo_loop = new WP_Query( $args );

                    if ( $novo_loop->have_posts() ) : while ( $novo_loop->have_posts() ) : $novo_loop->the_post();
                        ?>

                        <!-- single card -->
                        <div class="col-md-4 col-sm-6">
                            <div class="lab-card">
                                <div class="icon">
                                    <i class="<?php the_field('icones'); ?>"></i>
                                </div>
                                <h2><?php the_title(); ?></h2>
                                <p><?php the_content(); ?></p>
                            </div>
                        </div>
                    <?php
                    endwhile;
                    else :
                    ?>

                    <?php
                    endif;
                    wp_reset_postdata();
                    ?>


                </div>
			</div>
		</div>
		<!-- card section end-->


		<!-- About contant -->
		<div class="about-contant">
			<div class="container">
                <?php
                $query = new WP_Query(array( 'pagename' => 'inicio' ));

                if($query->have_posts()){
                    while($query->have_posts()){
                        $query->the_post(); ?>



				<div class="section-title">
					<h2><?php the_field('titulo'); ?></h2>
				</div>
				<div class="row">
					<div class="col-md-12">
						<p><?php the_field('texto'); ?></p>
					</div>
				</div>

				<div class="text-center mt60">
					<a href="/sobre" class="site-btn">Sobre nós</a>
				</div>
				<!-- popup video -->
				<div class="intro-video">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<img src="<?php the_field('video_thumbnail'); ?>" alt="">
							<a href="<?php the_field('video'); ?>" class="video-popup">
								<i class="fa fa-play"></i>
							</a>
						</div>
					</div>
				</div>


                        <?php
                    }
                }

                wp_reset_postdata();
                ?>
			</div>
		</div>
	</div>
	<!-- About section end -->


	<!-- Testimonial section -->
	<div class="testimonial-section pb100">
		<div class="test-overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-4">
					<div class="section-title left">
                       <h2>O que clientes dizem de nós</h2>
                    </div>
					<div class="owl-carousel" id="testimonial-slide">

                        <?php query_posts('post_type=depoimentos'); ?>

                        <?php if (have_posts()): while(have_posts()): the_post(); ?>
						<!-- single testimonial -->
						<div class="testimonial">
							<span>‘​‌‘​‌</span>
							<p><?php the_field('depoimento'); ?></p>
							<div class="client-info">
								<div class="avatar">
									<img src="<?php the_field('imagem'); ?>" alt="">
								</div>
								<div class="client-name">
									<h2><?php the_title(); ?></h2>
									<p><?php the_field('empresa'); ?></p>
								</div>
							</div>
						</div>


                        <?php endwhile; ?>

                        <?php else: ?>

                        <?php endif; ?>
                        <?php wp_reset_query(); ?>



					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Testimonial section end-->


	<!-- Promotion section -->
	<div class="promotion-section">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<h2>Fale conosco e diga como podemos te ajudar.</h2>
					<p>Preencha nosso formulário de contato.</p>
				</div>
				<div class="col-md-3">
					<div class="promo-btn-area">
						<a href="/contato" class="site-btn btn-2">Fale conosco</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Promotion section end-->



    <?php require_once 'footer.php'; ?>


