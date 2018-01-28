<?php
/*
 * template name: Single
 */

require_once 'header.php';
require_once 'includes/title.php';

?>

	<!-- page section -->
	<div class="page-section spad">
		<div class="container">
			<div class="row">
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();

                ?>
				<div class="col-md-8 col-sm-7 blog-posts">

					<!-- Single Post -->
					<div class="single-post">
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
								<a href=""><?php $comments_count =  wp_count_comments( $post->ID ); echo $comments_count->approved; ?> Comments</a>
							</div>
                            <p><?php the_content(); ?></p>
                        </div>



						<!-- Post Author -->
						<div class="author">
							<div class="avatar">
                                <?php
                                $author_avatar = get_avatar_url( get_the_author_meta( 'ID' ), $post->post_author );
                                ?>
								<img src="<?php echo $author_avatar; ?>" alt="">
							</div>
							<div class="author-info">
								<h2><?php $user_post = get_the_author_meta( 'first_name' ) . " " . get_the_author_meta( 'last_name' ); echo $user_post; ?></h2>
								<p><?php echo nl2br(get_the_author_meta('description')); ?></p>
							</div>
						</div>


                        <div class="comments">
                            <?php comments_template(); ?>
                        </div>
					</div>
				</div>
                <?php endwhile; ?>

                <?php require_once 'sidebar.php'; ?>
			</div>
		</div>
	</div>
	<!-- page section end-->



<?php require_once 'includes/newsletter.php'; ?>
<?php require_once 'footer.php'; ?>
