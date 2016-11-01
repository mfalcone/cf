<?php
if(is_user_logged_in()){
		wp_redirect(home_url().'/actividad'); exit;
	} 

/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package victoriacolectiva
 */
get_header(); ?>
			<div class="desc col-md-4 col-md-offset-4">
					<h1>Hagamos <img src="<? echo get_template_directory_uri().'/img/logo_principal.png' ?>" alt="Ciudad Futura"></h1>
					<p>Hagamos Ciudad Futura es una red social para la participación ciudadana creada en Rosario por Ciudad Futura. El objetivo es que quien quiera brindar su aporte para la construcción de una sociedad más justa tenga un ámbito ideado acordemente para poder volcar sus ideas, proyectos y experiencias. La plataforma es de libre ingreso. ¡Bienvenidos!</p>
			</div>
			<div class="login col-md-3">
			<?php 
			if($codes = pippin_errors()->get_error_codes()) {
				echo '<div class="pippin_errors">';
				    // Loop error codes and display errors
				   foreach($codes as $code){
				        $message = pippin_errors()->get_error_message($code);
				        echo '<span class="error"><strong>' . __('Error') . '</strong>: ' . $message . '</span><br/>';
				    }
				echo '</div>';
			}	
			 ?>
		
			<h2>Por favor, ingresá tu correo electrónico y tu contraseña </h2>
			<h3>Iniciar sesión</h3>
			<form id="pippin_login_form" class="pippin_form"action="" method="post">
				<fieldset>
					<p>
						<span class="glyphicon glyphicon-envelope" title="Correo Electrónico"></span>
						<input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
					</p>
					<p>
						<span class="glyphicon glyphicon-asterisk" title="Contraseña"></span>
						<input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
					</p>
					<footer>
						<input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>"/>
						<input id="login-submit" type="submit" value="Login"/>
					</footer>
				</fieldset>
			</form>
			<div class="registrarse">
				<a href="<?php echo get_site_url(); ?>/registrar">Registrarse</a>
			</div>
			<div class="reset">
				<a href="<?php echo get_site_url(); ?>/reset">Olvidé mi contraseña</a>
			</div>
		</div>

<?php
if(is_user_logged_in()){
get_footer();
}
