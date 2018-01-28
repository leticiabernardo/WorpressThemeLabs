    <?php
    /*
     * template name: Servicos
     */

    require_once 'header.php';
    require_once 'includes/title.php';

    ?>


	<!-- services section -->
	<div class="services-section spad">
		<div class="container">
			<div class="section-title dark">
				<h2>Nossos <span>serviços</span></h2>
			</div>
			<div class="row">

                <?php query_posts('post_type=servicos'); ?>

                    <?php if (have_posts()): while(have_posts()): the_post(); ?>


                        <!-- single service -->
                        <div class="col-md-4 col-sm-6">
                            <div class="service">
                                <div class="icon">
                                    <i class="<?php the_field('icones'); ?>"></i>
                                </div>
                                <div class="service-text">
                                    <h2><?php the_title(); ?></h2>
                                    <p><?php the_content(); ?></p>
                                </div>
                            </div>
                        </div>


                     <?php endwhile; ?>

                    <?php else: ?>

                        Não há serviços cadastrados

                    <?php endif; ?>
                <?php wp_reset_query(); ?>
			</div>

		</div>
	</div>
	<!-- services section end -->

    <?php require_once 'includes/newsletter.php'; ?>
    <?php require_once 'footer.php'; ?>
