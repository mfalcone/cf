<?php /* Template Name: Insertar Foto del día */

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
		'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
		'post_content' => esc_attr(strip_tags($_POST['postContent'])),
		'post_type' => 'post',
		'post_status' => 'publish',
		'post_category' => array($cat)
	);

	$post_id = wp_insert_post($post_information);

	if($post_id)
	{
		  if (!function_exists('wp_generate_attachment_metadata')){
                require_once(ABSPATH . "wp-admin" . '/includes/image.php');
                require_once(ABSPATH . "wp-admin" . '/includes/file.php');
                require_once(ABSPATH . "wp-admin" . '/includes/media.php');
            }
             if ($_FILES) {
                foreach ($_FILES as $file => $array) {
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
		// Update Custom Meta
		/*update_post_meta($post_id, 'fecha_inicio', esc_attr(strip_tags($_POST['fecha_inicio'])));
		update_post_meta($post_id, 'horario_inicio', esc_attr(strip_tags($_POST['horario_inicio'])));
		update_post_meta($post_id, 'fecha_fin', esc_attr(strip_tags($_POST['fecha_fin'])));
		update_post_meta($post_id, 'horario_fin', esc_attr(strip_tags($_POST['horario_fin'])));
		//update_post_meta($post_id, 'vsip_custom_two', esc_attr(strip_tags($_POST['customMetaTwo'])));*/

		// Redirect
		wp_redirect( home_url() ); exit;
	}

} ?>

<?php get_header(); ?>
<h2>Ingresar una Foto</h2>
	<!-- #primary BEGIN -->
	<div id="primary">

		<form action="" id="primaryPostForm" method="POST" enctype="multipart/form-data">

			<fieldset>

				<label for="postTitle">Título de la nota </label>

				<input type="text" name="postTitle" id="postTitle" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="required" />

			</fieldset>

			<?php if($postTitleError != '') { ?>
				<span class="error"><?php echo $postTitleError; ?></span>
				<div class="clearfix"></div>
			<?php } ?>

			
			<fieldset>
						
				<label for="postContent">Contenido</label>

				<textarea name="postContent" id="postContent" rows="8" cols="30"><?php if(isset($_POST['postContent'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['postContent']); } else { echo $_POST['postContent']; } } ?></textarea>

			</fieldset>

			<fieldset>
						
				<label for="postContent">Foto:</label>

				<input type="file" name="thumbnail" id="thumbnail">

			</fieldset>

			<fieldset>
				
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit">Enviar</button>

			</fieldset>


		</form>

	</div><!-- #primary END -->


<?php get_footer(); ?>