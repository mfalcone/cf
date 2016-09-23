<?php
/**
 * victoriacolectiva functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package victoriacolectiva
 */

/**
 * Enqueue scripts and styles.
 */
function victoriacolectiva_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery',  get_template_directory_uri() . '/js/jquery-1.12.3.min.js');
	wp_enqueue_script( 'myfunctions',  get_template_directory_uri() . '/js/main.js',array('jquery'),'1.0' );
	// wp_register_style() example
	wp_register_style('style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'style' );
}
add_action( 'wp_enqueue_scripts', 'victoriacolectiva_scripts' );


function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Menu principal' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );

function is_login_page() {
    return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}


if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}



function my_redirect() {  
    //if you have the page id of landing. I would tell you to use if( is_page('page id here') instead
    //Don't redirect if user is logged in or user is trying to sign up or sign in
    if(!is_front_page()  && !is_page('29') && !is_admin() && !is_user_logged_in()){
        	wp_safe_redirect( home_url( '/' ) );
        	print_r("a");
            }
}
//add_action( 'template_redirect', 'my_redirect' );

// used for tracking error messages
function pippin_errors(){
    static $wp_error; // Will hold global variable safely
    return isset($wp_error) ? $wp_error : ($wp_error = new WP_Error(null, null, null));
}



function pippin_login_member() {
 
	if(isset($_POST['pippin_user_login']) && wp_verify_nonce($_POST['pippin_login_nonce'], 'pippin-login-nonce')) {
 
		// this returns the user ID and other info from the user name
		$user = get_userdatabylogin($_POST['pippin_user_login']);
 
		if(!$user) {
			// if the user name doesn't exist
			pippin_errors()->add('empty_username', __('Invalid username'));
		}
 
		if(!isset($_POST['pippin_user_pass']) || $_POST['pippin_user_pass'] == '') {
			// if no password was entered
			pippin_errors()->add('empty_password', __('Please enter a password'));
		}
 
		// check the user's login with their password
		if(!wp_check_password($_POST['pippin_user_pass'], $user->user_pass, $user->ID)) {
			// if the password is incorrect for the specified user
			pippin_errors()->add('empty_password', __('Incorrect password'));
		}
 
		// retrieve all error messages
		$errors = pippin_errors()->get_error_messages();
 
		// only log the user in if there are no errors
		if(empty($errors)) {
 
			wp_setcookie($_POST['pippin_user_login'], $_POST['pippin_user_pass'], true);
			wp_set_current_user($user->ID, $_POST['pippin_user_login']);	
			do_action('wp_login', $_POST['pippin_user_login']);
 
			wp_redirect(home_url().'/actividad'); exit;
		}
	}
}
add_action('init', 'pippin_login_member');


// add the custom column header
function philopress_modify_user_columns($column_headers) {

        $column_headers['extended'] = 'Extended';
  
        return $column_headers;
}
add_action('manage_users_page_bp-signups_columns','philopress_modify_user_columns');

// dump all the pending user's meta data in the custom column
function philopress_signup_custom_column( $str, $column_name, $signup_object ) {

	if ( $column_name == 'extended' ) 
             return print_r( $signup_object->meta, true );

        return $str;
}
add_filter( 'bp_members_signup_custom_column', 'philopress_signup_custom_column', 1, 3 );

/*esta función setea el rol  de usuarioredsocial cuando se aprueba un usuario */

add_action('bp_core_activated_user', 'bp_custom_registration_role',10 , 3);

function bp_custom_registration_role($user_id, $key, $user) {
   $userdata = array();
   $userdata['ID'] = $user_id;
   $userdata['role'] = 'usuarioredsocial';
    wp_update_user($userdata);


  }


  function mandarMail(){
  	$to = 'maxifalcone@gmail.com';
	$subject = 'probando esta garompa';
	$message =  'si esto anda me hago puto';

	wp_mail( $to, $subject, $message );
  }

  //add_action('init', 'mandarMail');
