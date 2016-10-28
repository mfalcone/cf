<?php /* Template Name: Editar foto */ 
$query = new WP_Query(array('post_type' => 'post', 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'private', 'trash') ) );

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
	
	if(isset($_GET['post'])) {
		
		if($_GET['post'] == $post->ID)
		{
			$current_post = $post->ID;

			$title = get_the_title();
			$content = get_the_content();
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id,'medium', true);
			

		}
	}

endwhile; endif;
wp_reset_query();

global $current_post;

$postTitleError = '';

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	if(trim($_POST['postTitle']) === '') {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	} else {
		$postTitle = trim($_POST['postTitle']);
	}

	$cat=get_cat_ID( 'foto_del_dia' );

	$post_information = array(
		'ID' => $current_post,
		'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
		'post_content' => esc_attr(strip_tags($_POST['postContent'])),
		'post-type' => 'post',
		'post_status' => 'publish',
		'post_category' => array($cat)		
	);

	$post_id = wp_update_post($post_information);

	if($post_id)
	{
			if (!function_exists('wp_generate_attachment_metadata')){
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }
             if ($_FILES) {
             	
                foreach ($_FILES as $file => $array) {
                	if($_FILES[$file]['size']==0){
                		break;
                	};
                    if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
                        return "upload error : " . $_FILES[$file]['error'];
                    }
                    $attach_id = media_handle_upload( $file, $post_id );
                }  
            }

            if ($attach_id > 0){
                //and if you want to set that image as Post  then use:
                update_post_meta($post_id,'_thumbnail_id',$attach_id);
            }
		// Redirect
		wp_redirect( home_url() ); exit;
	}

}

?>

<?php get_header(); ?>

	<!-- #primary BEGIN -->
	<div id="primary">

		<form action="" id="primaryPostForm" method="POST" enctype="multipart/form-data">

			<fieldset>

				<label for="postTitle"><?php _e('Post\'s Title:', 'framework') ?></label>

				<input type="text" name="postTitle" id="postTitle" value="<?php echo $title; ?>" class="required" />

			</fieldset>

			<?php if($postTitleError != '') { ?>
				<span class="error"><?php echo $postTitleError; ?></span>
				<div class="clearfix"></div>
			<?php } ?>

			<fieldset>
						
				<label for="postContent"><?php _e('Post\'s Content:', 'framework') ?></label>
				<div class="editor-wrap">
				<div id="toolbar" style="display: none;">
				    <a data-wysihtml5-command="bold" title="CTRL+B" class="bold">B</a> 
				    <a data-wysihtml5-command="italic" title="CTRL+I" class="italic">I</a>
				    <!--<a data-wysihtml5-action="change_view">switch to html view</a>-->
				</div>
				<textarea name="postContent" id="postContent" rows="8" cols="30"><?php echo $content; ?></textarea>
				</div>

			</fieldset>

			<fieldset>
				<label for="postContent">Foto:</label>
				<img src="<?php echo $thumb_url[0]; ?>" />
				<input type="file" name="thumbnail" id="thumbnail">

			</fieldset>

			<fieldset>
				
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit">Actualizar foto</button>

			</fieldset>

		</form>


	</div><!-- #primary END -->


<?php get_footer(); ?>