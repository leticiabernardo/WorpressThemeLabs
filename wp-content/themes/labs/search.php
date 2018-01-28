página de pesquisa
<?php
/*
 * template name: Busca
 */

require_once 'header.php';

?>

<!-- page section -->
	<div class="page-section spad">
		<div class="container">
			<div class="row">


				<div class="col-md-8 col-sm-7 blog-posts">



                    <?php if ( have_posts() ) : ?>

                        <h3 class="page-title">Resultados para: <span><?php the_search_query(); ?></span></h3><br><br>


                        <?php while ( have_posts() ) : the_post() ?>

                                <?php if ( $post->post_type == 'post' ) { ?>

                                    <div class="post-item">
                                        <?php
                                        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
                                        $img = $image[0];

                                        if ($img) {
                                        ?>
                                        <div class="post-thumbnail">

                                            <img src="<?php echo $img; ?>" alt="">
                                            <div class="post-date">
                                                <h2><?php $post_day = get_the_date( 'j' ); echo $post_day; ?></h2>
                                                <h3><?php $post_date = get_the_date( 'M Y' ); echo $post_date; ?></h3>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="post-content">
                                            <h2 class="post-title"><?php the_title(); ?></h2>
                                            <div class="post-meta">
                                                <a href="<?php bloginfo('url'); ?>/author/<?php the_author(); ?>"><?php $author = get_the_author(); echo $author; ?></a>
                                                <a href="">
                                                    <?php
                                                    $category_detail= get_the_category($post->ID);//$post->ID
                                                    foreach($category_detail as $cd){
                                                        echo $cd->cat_name . ", ";
                                                    } ?>
                                                </a>
                                                <a href=""><?php $comments_count =  wp_count_comments( $post->ID ); echo $comments_count->approved; ?>  Comentários</a>

                                            </div>
                                            <p><?php echo wp_trim_words( get_the_content(), 20, '...' ); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="read-more">Leia Mais</a>
                                        </div>
                                    </div>

                                <?php } ?>

                        <?php endwhile; ?>

                        <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
                            <div id="nav-below" class="navigation">
                                <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">«</span> Older posts', 'seu-template' )) ?></div>
                                <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">»</span>', 'seu-template' )) ?></div>
                            </div><!– #nav-below –>
                        <?php } ?>

                    <?php else : ?>

                        <div id="post-0" class="post no-results not-found">
                            <h2 class="entry-title">Não há resultados...</h2>
                            <div class="entry-content">
                                <?php get_search_form(); ?>
                            </div>
                        </div>

                    <?php endif; ?>
                </div>


                <?php require_once 'sidebar.php'; ?>
                <?php require_once 'includes/newsletter.php'; ?>
                <?php require_once 'footer.php'; ?>
