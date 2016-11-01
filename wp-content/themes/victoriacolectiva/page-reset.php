<?php  
/* 
Template Name: Reset Page
*/

get_header()
?>
<div class="wrapper">
	
	<?php
		global $wpdb;
		
		$error = '';
		$success = '';
		
		// check if we're in reset form
		if( isset( $_POST['action'] ) && 'reset' == $_POST['action'] ) 
		{
			$email = trim($_POST['user_login']);
			
			if( empty( $email ) ) {
				$error = 'Enter a username or e-mail address..';
			} else if( ! is_email( $email )) {
				$error = 'Invalid username or e-mail address.';
			} else if( ! email_exists( $email ) ) {
				$error = 'There is no user registered with that email address.';
			} else {
				
				$random_password = wp_generate_password( 12, false );
				$user = get_user_by( 'email', $email );
				
				$update_user = wp_update_user( array (
						'ID' => $user->ID, 
						'user_pass' => $random_password
					)
				);
				
				// if  update user return true then lets send user an email containing the new password
				if( $update_user ) {
					$to = $email;
					$subject = 'Tu nueva contraseña';
					$sender = get_option('name');
					
					$message = 'Tu nueva contraseña es: '.$random_password;
					
					$headers[] = 'MIME-Version: 1.0' . "\r\n";
					$headers[] = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$headers[] = "X-Mailer: PHP \r\n";
					$headers[] = 'From: '.$sender.' < '.$email.'>' . "\r\n";
					
					$mail = wp_mail( $to, $subject, $message, $headers );
					if( $mail )
						$success = 'Revisá tu correo electrónico y obetené tu nueva contraseña';
						
				} else {
					$error = 'Hubo un error, inténtalo más tarde';
				}
				
			}
			
			if( ! empty( $error ) )
				echo '<div class="msg message col-md-8 col-md-offset-2"><p class="error"><strong>ERROR:</strong> '. $error .'</p></div>';
			
			if( ! empty( $success ) )
				echo '<div class="msg error_login col-md-8 col-md-offset-2"><p class="success">'. $success .'</p></div>';
		}
	?>

	<!--html code-->
	<form method="post" class="reset-form col-md-8 col-md-offset-2">
		<fieldset>
			<p>Por favor ingresá tu correo electrónico y recibirás una nueva contraseña</p>
			<p><label for="user_login">Correo eletrónico:</label>
				<?php $user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : ''; ?>
				<input type="text" name="user_login" id="user_login" value="<?php echo $user_login; ?>" </p>
			<p>
				<input type="hidden" name="action" value="reset" />
				<input type="submit" value="Obtené una nueva contraseña" class="button" id="submit" />
			</p>
		</fieldset> 
	</form>
</div>

<?php get_footer() ?>