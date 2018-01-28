
<!-- Sidebar area -->
<div class="col-md-4 col-sm-5 sidebar">
    <!-- Single widget -->
    <div class="widget-item">
        <?php get_search_form(); ?>
    </div>
    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Categorias</h2>
        <ul>
            <?php
            $categories = get_categories( array(
                'orderby' => 'name',
                'parent'  => 0
            ) );

            foreach ( $categories as $category ) {
                printf( '<li><a href="%1$s">%2$s</a></li>',
                    esc_url( get_category_link( $category->term_id ) ),
                    esc_html( $category->name )
                );
            } ?>

        </ul>
    </div>
    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Instagram</h2>
        <?php echo do_shortcode( '[instagram-feed showbutton=false showfollow=false showheader=false]' ); ?>
    </div>
    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Tags</h2>
        <ul class="tag">
            <?php
            $tags = get_tags();
            foreach ( $tags as $tag ) {
                $tag_link = get_tag_link( $tag->term_id );

                $html .= "<li><a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
                $html .= "{$tag->name}</a></li>";
            }
            echo $html;

            ?>
        </ul>
    </div>

    <!-- Single widget -->
    <div class="widget-item">
        <h2 class="widget-title">Publicidade</h2>

        <?php query_posts('post_type=publicidade'); ?>

        <?php if (have_posts()): while(have_posts()): the_post(); ?>

            <div class="add">
                <a href=""><img src="<?php the_field('imagem'); ?>" alt=""></a>
            </div>


        <?php endwhile; ?>

        <?php else: ?>

            <div class="add">
                <a href=""><img src="<?php bloginfo('template_url');?>/img/add.jpg" alt=""></a>
            </div>

        <?php endif; ?>
        <?php wp_reset_query(); ?>


    </div>
</div>
</div>
</div>
</div>
<!-- page section end-->
