<?php
if(is_user_logged_in()){
		//wp_redirect(home_url().'/activity'); exit;
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
		<div class="login">
			<form id="pippin_login_form" class="pippin_form"action="" method="post">
				<fieldset>
					<p>
						<label for="pippin_user_Login">Username</label>
						<input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
					</p>
					<p>
						<label for="pippin_user_pass">Password</label>
						<input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
					</p>
					<p>
						<input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>"/>
						<input id="pippin_login_submit" type="submit" value="Login"/>
					</p>
				</fieldset>
			</form>
		</div>
		<a href="<?php echo get_site_url(); ?>/registrar">Registrar</a>

<?php
get_sidebar();
get_footer();
