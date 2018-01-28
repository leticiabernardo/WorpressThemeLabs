<?php
/*
 * template name: Blog
 */

require_once 'header.php';
require_once 'includes/title.php';

?>

<!-- page section -->
	<div class="page-section spad">
		<div class="container">
			<div class="row">


				<div class="col-md-8 col-sm-7 blog-posts">

                    <?php
                    // the query to set the posts per page to 3
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $args = array('posts_per_page' => 5, 'paged' => $paged );
                    query_posts($args); ?>
                    <!-- the loop -->
                    <?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
                        <div class="post-item">
                            <div class="post-thumbnail">
                                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' ); ?>
                                <img src="<?php echo $image[0]; ?>" alt="">
                                <div class="post-date">
                                    <h2><?php $post_day = get_the_date( 'j' ); echo $post_day; ?></h2>
                                    <h3><?php $post_date = get_the_date( 'M Y' ); echo $post_date; ?></h3>
                                </div>
                            </div>
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
                    <?php endwhile; ?>
                        <!-- pagination -->
                    <div class="page-pagination">

                        <p style="float:right"><?php next_posts_link(); ?></p>
                        <?php previous_posts_link(); ?>

                    </div>
                    <?php else : ?>
                        <!-- No posts found -->
                    <?php endif; ?>

				</div>




    <?php require_once 'sidebar.php'; ?>
    <?php require_once 'includes/newsletter.php'; ?>
    <?php require_once 'footer.php'; ?>
