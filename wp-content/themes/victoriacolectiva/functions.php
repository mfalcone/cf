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

function bp_dtheme_setup() {

	// Load the AJAX functions for the theme
	require( get_template_directory() . '/_inc/ajax.php' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// This theme comes with all the BuddyPress goodies
	add_theme_support( 'buddypress' );

	// This theme uses post thumbnails
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add responsive layout support to bp-default without forcing child
	// themes to inherit it if they don't want to
	add_theme_support( 'bp-default-responsive' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'buddypress' ),
	) );

	// This theme allows users to set a custom background
	$custom_background_args = array(
		'wp-head-callback' => 'bp_dtheme_custom_background_style'
	);
	add_theme_support( 'custom-background', $custom_background_args );

	// Add custom header support if allowed
	if ( !defined( 'BP_DTHEME_DISABLE_CUSTOM_HEADER' ) ) {
		define( 'HEADER_TEXTCOLOR', 'FFFFFF' );

		// The height and width of your custom header. You can hook into the theme's own filters to change these values.
		// Add a filter to bp_dtheme_header_image_width and bp_dtheme_header_image_height to change these values.
		define( 'HEADER_IMAGE_WIDTH',  apply_filters( 'bp_dtheme_header_image_width',  1250 ) );
		define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'bp_dtheme_header_image_height', 133  ) );

		// We'll be using post thumbnails for custom header images on posts and pages. We want them to be 1250 pixels wide by 133 pixels tall.
		// Larger images will be auto-cropped to fit, smaller ones will be ignored.
		set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

		// Add a way for the custom header to be styled in the admin panel that controls custom headers.
		$custom_header_args = array(
			'wp-head-callback' => 'bp_dtheme_header_style',
			'admin-head-callback' => 'bp_dtheme_admin_header_style'
		);
		add_theme_support( 'custom-header', $custom_header_args );
	}

	if ( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
		// Register buttons for the relevant component templates
		// Friends button
		if ( bp_is_active( 'friends' ) )
			add_action( 'bp_member_header_actions',    'bp_add_friend_button',           5 );

		// Activity button
		if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() )
			add_action( 'bp_member_header_actions',    'bp_send_public_message_button',  20 );

		// Messages button
		if ( bp_is_active( 'messages' ) )
			add_action( 'bp_member_header_actions',    'bp_send_private_message_button', 20 );

		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions',     'bp_group_join_button',           5 );
			add_action( 'bp_group_header_actions',     'bp_group_new_topic_button',      20 );
			add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) )
			add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
	}
}


add_action( 'after_setup_theme', 'bp_dtheme_setup' );


function victoriacolectiva_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery',  get_template_directory_uri() . '/js/jquery-1.12.3.min.js');
	wp_enqueue_script( 'myfunctions',  get_template_directory_uri() . '/js/main.js',array('jquery'),'1.0' );
	// wp_register_style() example
	wp_register_style('style', get_template_directory_uri() . '/style.css');
	wp_enqueue_style( 'style' );
	wp_enqueue_script( 'bp-jquery-query' );
	wp_enqueue_script( 'bp-jquery-cookie' );
	wp_enqueue_script( 'dtheme-ajax-js', get_template_directory_uri() . '/_inc/global.js', array( 'jquery' ), bp_get_version() );

	wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );

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
		$user = get_user_by('email',$_POST['pippin_user_login']);
 		
		if(!$user) {
			//print_r(pippin_errors());
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

 
			wp_setcookie($user->user_login, $_POST['pippin_user_pass'], true);
			wp_set_current_user($user->ID,$user->user_login);	
			do_action('wp_login', $user->user_login);
 
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


// Example of function to customize the display of the cover image
function bp_default_cover_image( $params = array() ) {
	//print_r($params);
    
    if ( empty( $params ) ) {
        return;
    }else{
    	echo '
    	<style type="text/css" media="screen">
    	/* Cover image */
        #header-cover-image {
            display: block;
            background-image: url(' . $params['cover_image'] . ');
        }
    	</style>';
    }
    
}

// Register the Cover Image feature for Users profiles
function bp_default_register_feature() {
	/**
     * You can choose to register it for Members and / or Groups by including (or not) 
     * the corresponding components in your feature's settings. In this example, we
     * chose to register it for both components.
     */
    $components = array( 'groups', 'xprofile');
 
    // Define the feature's settings
    $cover_image_settings = array(
        'name'     => 'cover_image', // feature name
        'settings' => array(
            'components'   => $components,
            'width'        => 940,
            'height'       => 225,
            'callback'     => 'bp_default_cover_image',
            'theme_handle' => 'style',
        ),
    );
 
 
    // Register the feature for your theme according to the defined settings.
    bp_set_theme_compat_feature( bp_get_theme_compat_id(), $cover_image_settings );
}
add_action( 'bp_after_setup_theme', 'bp_default_register_feature' );


add_filter('body_class','my_class_names');
function my_class_names($classes) {
    if (! ( is_user_logged_in() ) ) {
        $classes[] = 'logged-out';
    }
    return $classes;
}

  function mandarMail(){
  	$to = 'maxifalcone@gmail.com';
	$subject = 'probando esta garompa';
	$message =  'si esto anda me hago puto';

	wp_mail( $to, $subject, $message );
  }

  //add_action('init', 'mandarMail');


function bp_remove_group_step_invites() {

	global $bp;
	//print_r($bp->groups->group_creation_steps);
	unset( $bp->groups->group_creation_steps['group-cover-image'] );
	unset( $bp->groups->group_creation_steps['group-invites'] );
	
}
add_action( 'bp_init', 'bp_remove_group_step_invites', 9999 ); 






function add_users_to_bpgroup() {   
    if( bp_is_active('groups') ):
 
        if( isset( $_GET['action'] ) && isset( $_GET['bp_gid'] ) && isset( $_GET['users'] ) ) {
            $group_id = $_GET['bp_gid'];
            $users = $_GET['users'];
             
            foreach ( $users as $user_id ) {
                groups_join_group( $group_id, $user_id );
            }
        }
        //form submission
        add_action( 'admin_footer', function() { ?>
            <script type="text/javascript" charset="utf-8">
                jQuery("select[name='action']").append(jQuery('<option value="groupadd">Add to BP Group</option>'));
                jQuery("#doaction").click(function(e){
                    if(jQuery("select[name='action'] :selected").val()=="groupadd") { e.preventDefault();
                        gid=prompt("Enter a Group ID","1");
                        jQuery(".wrap form").append('<input type="hidden" name="bp_gid" value="'+gid+'" />').submit();
                    }
                });
            </script>
        <?php
        });
         
    endif;
}
add_action ( 'load-users.php', 'add_users_to_bpgroup' );
