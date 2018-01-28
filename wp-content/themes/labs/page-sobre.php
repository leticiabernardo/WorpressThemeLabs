<?php
/*
 * template name: Sobre
 */

require_once 'header.php';
require_once 'includes/title.php';

?>


<!-- services section -->
<div class="services-section spad">
    <div class="container">
        <div class="section-title dark">
            <h2>Sobre <span>nós</span></h2>
        </div>
        <div class="row">

            <div class="col-md-12">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                    the_content();
                endwhile; else: ?>
                    <p>Não há texto sobre nós.</p>
                <?php endif; ?>


            </div>

        </div>

    </div>
</div>
<!-- services section end -->


<!-- Team Section -->
<div class="team-section spad">
    <div class="overlay"></div>
    <div class="container">
        <div class="section-title">
            <h2>Nossa <span>Equipe</span></h2>
        </div>
        <div class="row">
            <?php query_posts('post_type=equipe'); ?>

            <?php if (have_posts()): while(have_posts()): the_post(); ?>

                <!-- single member -->
                <div class="col-sm-4">
                    <div class="member">
                        <img src="<?php the_field('foto'); ?>" alt="">
                        <h2><?php the_title(); ?></h2>
                        <h3><?php the_field('funcao'); ?></h3>
                    </div>
                </div>

            <?php endwhile; ?>

            <?php else: ?>

                Não há equipe cadastrada

            <?php endif; ?>
            <?php wp_reset_query(); ?>
        </div>
    </div>
</div>
<!-- Team Section end-->


<?php require_once 'includes/newsletter.php'; ?>
<?php require_once 'footer.php'; ?>
