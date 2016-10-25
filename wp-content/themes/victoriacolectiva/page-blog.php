<?php /* Template Name:Blog */ 

$postTitleError = '';
$catslug=get_category_by_slug( 'momento_cf' );
$cat = $catslug->term_id;

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	if(trim($_POST['postTitle']) === '') {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	} else {
		$postTitle = trim($_POST['postTitle']);
	}

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
		wp_redirect( home_url()."/momentos-cf/" ); exit;
	}

} 

get_header(); 

if ( !current_user_can('organico') ) : 

	get_template_part( 'template-parts/nivel-usuario');
		
	else:
?>

	<div class="blog">
		<header>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<div class="content">
						<?php the_content();?>
					</div>
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
			<?php endif;  ?>
			<div class="bt"><span class="escribir">Escribir</span></div>
		</header>
		<div class="editor">
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

						<input type="file" name="thumbnail" id="thumbnail" label="elegir foto">

					</fieldset>

					<fieldset>
						
						<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

						<input type="hidden" name="submitted" id="submitted" value="true" />
						<button type="submit">Enviar</button>

					</fieldset>


				</form>

			</div><!-- #primary END -->
		
		</div>
		<section class="posteos">
			<?php
			$args = array( 'category_name' => 'momento_cf', 'posts_per_page' => -1 );
			$loop = new WP_Query( $args );
			$counter = 0;
			while ( $loop->have_posts() ) : $loop->the_post(); $counter++; ?>
			<article class="fotos <?php if( $counter % 2 == 0 ) { //It's even?>odd<?php }else{?>even<?php }?>">
				<div class="contenido col-md-6">
					<h2><?php the_title(); ?></h2>
					<div class="autor">Creada por <?php the_author();?></div>
					<?php the_content(); ?>
				</div>
				<div class="foto col-md-6">
					<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('large');
						}
					?>
				</div>
				<?php
				$user_id = get_current_user_id();
				$userpost = $post->post_author;
				if ($user_id == $userpost){  ?>
				<a href="<?php  echo get_home_url();?>/editar-el-momento/?post=<?php echo $post->ID?>">editar</a>
				<?php	}?>
			</article>
			<?php endwhile; // end of the loop. ?>
		</section>
	</div>
	<?php endif; ?>
<? get_footer() ?>