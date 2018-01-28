<style>
    <?php if (get_the_post_thumbnail()) : ?>
    .page-top-section .overlay {
        background-image: url('<?php the_post_thumbnail_url(); ?>');
    }
    <?php endif; ?>
</style>


<!-- Page header -->
<div class="page-top-section">
    <div class="overlay"></div>
    <div class="container text-right">
        <div class="page-info">
            <h2><?php the_title(); ?></h2>
            <div class="page-links">
                <a href="./">Início</a>
                <span><?php the_title(); ?></span>
            </div>
        </div>
    </div>
</div>
<!-- Page header end -->