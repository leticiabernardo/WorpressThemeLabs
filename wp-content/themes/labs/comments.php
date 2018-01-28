<?php
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
    <p class="nocomments">Este artigo está protegido por password. Insira-a para ver os comentários.</p>
    <?php
    return;
}
?>
<ol class="comment-list">

    <?php wp_list_comments( array(
        'style'      => 'ol',
        'short_ping' => true,
        'avatar_size'=> 34,
    ) );?>
</ol>
    <?php if ( comments_open() ) : ?>

    <div class="row">
        <div class="col-md-9 comment-from">
            <h2>Deixe um comentário</h2>

            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" class="form-class">
                <div class="row">
                    <?php if ( $user_ID ) : ?>

                        <p>Autentificado como <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(); ?>" title="Sair desta conta">Sair desta conta &raquo;</a></p>

                    <?php else : ?>


                            <div class="col-sm-6">
                                <input type="text" name="author" id="author" placeholder="Seu nome" value="<?php echo $comment_author; ?>">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" name="email" id="email" placeholder="Seu e-mail" value="<?php echo $comment_author_email; ?>">
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="url" id="url" placeholder="Seu website" value="<?php echo $comment_author_url; ?>" />
                            </div>



                    <?php endif; ?>

                    <div class="col-sm-12">
                        <textarea  name="comment" id="comment" rows="" cols="" placeholder="Mensagem"></textarea>
                        <button class="site-btn commentsubmit">Enviar Comentário</button>
                    </div>

                    <?php comment_id_fields(); ?>
                    <?php do_action('comment_form', $post->ID); ?>
                </div>
            </form>
        </div>
    <?php else : ?>
        <h3>Os comentários estão fechados.</h3>
    <?php endif; ?>
</div>