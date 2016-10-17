<?php $comments_args = array(
        // Change the title of send button 
        'label_submit' => __( 'Enviar', 'textdomain' ),
        // Change the title of the reply section
        'title_reply' => __( 'Dejá un comentario', 'textdomain' ),
        // Remove "Text or HTML to be displayed after the set of comment fields".
        'comment_notes_after' => '',
        // Redefine your own textarea (the comment body).
        'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true"></textarea></p>',
);
comment_form( $comments_args ); ?>
<?php if($comments) { ?>
    <ol>
        <?php foreach($comments as $comment) { ?>
            <li id="comment-<?php comment_ID(); ?>">
                <?php if ($comment->comment_approved == '0') { ?>
                    <p>Your comment is awaiting approval</p>
                <?php }
                comment_text(); ?>
                <cite><?php comment_type(); ?> by <?php comment_author_link(); ?> on <?php comment_date(); ?> at <?php comment_time(); ?></cite>
            </li>
        <?php } ?>
    </ol>
<?php } else { ?>
    <p>No comments yet</p>
<?php } ?>