<?php $comments_args = array(
        // Change the title of send button 
        'label_submit' => __( 'Enviar', 'textdomain' ),
        // Change the title of the reply section
        'title_reply' => __( 'Dejá un comentario', 'textdomain' ),
        // Remove "Text or HTML to be displayed after the set of comment fields".
        'comment_notes_after' => '',
        // Redefine your own textarea (the comment body).
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
);?>
<?php if($comments) { ?>
    <ul class="comentarios">
        <?php foreach($comments as $comment) { ?>
            <li id="comment-<?php comment_ID(); ?>" class="row">
                <?php if ($comment->comment_approved == '0') { ?>
                    <p>Your comment is awaiting approval</p>
                <?php }?>
                <div class="avatar-wrapper col-md-1"><?php echo get_avatar( $comment, $args['avatar_size'] ); ?></div>
                <div class="comment-wrapper col-md-11"><span class="author"><?php comment_author_link(); ?></span><?php comment_text(); ?>
                <cite>
                    <?php comment_date(); ?> a las <?php comment_time(); ?>
                </cite>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php }

comment_form( $comments_args ); ?>
