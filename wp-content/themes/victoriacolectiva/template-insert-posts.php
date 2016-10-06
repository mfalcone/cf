<?php /* Template Name: Insertar Evento */

$postTitleError = '';

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
		'post_type' => 'agenda',
		'post_status' => 'pending'
	);

	$post_id = wp_insert_post($post_information);

	if($post_id)
	{

		// Update Custom Meta
		update_post_meta($post_id, 'fecha_inicio', esc_attr(strip_tags($_POST['fecha_inicio'])));
		update_post_meta($post_id, 'horario_inicio', esc_attr(strip_tags($_POST['horario_inicio'])));
		update_post_meta($post_id, 'fecha_fin', esc_attr(strip_tags($_POST['fecha_fin'])));
		update_post_meta($post_id, 'horario_fin', esc_attr(strip_tags($_POST['horario_fin'])));
		//update_post_meta($post_id, 'vsip_custom_two', esc_attr(strip_tags($_POST['customMetaTwo'])));

		// Redirect
		wp_redirect( home_url() ); exit;
	}

} ?>

<?php get_header(); ?>
<h2>Ingresar un Evento</h2>
	<!-- #primary BEGIN -->
	<div id="primary">

		<form action="" id="primaryPostForm" method="POST">

			<fieldset>

				<label for="postTitle">Título del evento</label>

				<input type="text" name="postTitle" id="postTitle" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="required" />

			</fieldset>

			<?php if($postTitleError != '') { ?>
				<span class="error"><?php echo $postTitleError; ?></span>
				<div class="clearfix"></div>
			<?php } ?>

			<fieldset>

				<label for="fecha_inicio">Fecha de Inicio</label>

				<input type="date" name="fecha_inicio" id="fecha_inicio" value="<?php if(isset($_POST['fecha_inicio'])) echo $_POST['fecha_inicio'];?>" />

			</fieldset>

			<fieldset>

				<label for="horario_inicio">Hora de Inicio</label>

				<input type="time" name="horario_inicio" id="horario_inicio" value="<?php if(isset($_POST['horario_inicio'])) echo $_POST['horario_inicio'];?>" />

			</fieldset>

			<fieldset>

				<label for="fecha_fin">Fecha de Finalización</label>

				<input type="date" name="fecha_fin" id="fecha_fin" value="<?php if(isset($_POST['fecha_fin'])) echo $_POST['fecha_fin'];?>" />

			</fieldset>

			<fieldset>

				<label for="horario_fin">Hora de Finalización</label>

				<input type="time" name="horario_fin" id="horario_fin" value="<?php if(isset($_POST['horario_fin'])) echo $_POST['horario_fin'];?>" />

			</fieldset>


			<fieldset>
						
				<label for="postContent">Descripción</label>

				<textarea name="postContent" id="postContent" rows="8" cols="30"><?php if(isset($_POST['postContent'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['postContent']); } else { echo $_POST['postContent']; } } ?></textarea>

			</fieldset>
			

			<fieldset>
				
				<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

				<input type="hidden" name="submitted" id="submitted" value="true" />
				<button type="submit">Enviar</button>

			</fieldset>


		</form>

	</div><!-- #primary END -->


<?php get_footer(); ?>