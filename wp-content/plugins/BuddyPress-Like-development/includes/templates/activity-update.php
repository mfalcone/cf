<?php
/**
 * BuddyPress Like - Activty Update Button
 *
 * This function is used to display the BuddyPress Like button on updates in the activity stream
 *
 * @package BuddyPress Like
 *
 */

/*
 * bplike_activity_update_button()
 *
 * Outputs Like/Unlike button for activity updates.
 *
 */
function bplike_activity_update_button() {

    $liked_count = 0;

    if ( is_user_logged_in() ) {
      if ( bp_get_activity_type() !== 'activity_liked' && bp_get_activity_type() != 'blogpost_liked' ) {
        if ( bp_activity_get_meta( bp_get_activity_id(), 'liked_count', true ) ) {
            $users_who_like = array_keys( bp_activity_get_meta( bp_get_activity_id(), 'liked_count', true ) );
            $liked_count = count( $users_who_like );
        }?>
        <div class="like-unlike-wrapper">
        <?php if ( ! bp_like_is_liked( bp_get_activity_id(), 'activity_update', get_current_user_id() ) ) {
            ?>
            <div class="dedos"></div>
            <a href="#" class="button bp-primary-action like" id="like-activity-<?php echo bp_get_activity_id(); ?>" title="<?php echo bp_like_get_text( 'like_this_item' ); ?>">
                <?php
                    echo bp_like_get_text( 'like' );
                    echo ' <span>' . ( $liked_count ? $liked_count : '0' ) . '</span>';
                ?>
            </a>
        <?php } else { ?>
            <div class="dedos tres-dedos"></div>
            <a href="#" class="button bp-primary-action unlike" id="unlike-activity-<?php echo bp_get_activity_id(); ?>" title="<?php echo bp_like_get_text( 'unlike_this_item' ); ?>">
                <?php
                    echo bp_like_get_text( 'unlike' );
                    echo ' <span>' . ( $liked_count ? $liked_count : '0' ) . '</span>';
                ?>
            </a>
            <?php
        }?>
        </div>
        <?php
        // Checking if there are users who like item.
        view_who_likes( bp_get_activity_id(), 'activity_update' );
      }
    }
}
