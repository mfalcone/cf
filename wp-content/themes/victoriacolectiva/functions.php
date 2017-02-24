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


if ( ! defined( 'BP_AVATAR_THUMB_WIDTH' ) )
	define( 'BP_AVATAR_THUMB_WIDTH', 50 ); //change this with your desired thumb width

if ( ! defined( 'BP_AVATAR_THUMB_HEIGHT' ) )
	define( 'BP_AVATAR_THUMB_HEIGHT', 50 ); //change this with your desired thumb height

if ( ! defined( 'BP_AVATAR_FULL_WIDTH' ) )
	define( 'BP_AVATAR_FULL_WIDTH', 560 ); //change this with your desired full size,weel I changed it to 260 :)

if ( ! defined( 'BP_AVATAR_FULL_HEIGHT' ) )
	define( 'BP_AVATAR_FULL_HEIGHT', 560 ); //change this to default height for full avatar



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
	/*register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'buddypress' ),
	) );
*/
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
	wp_enqueue_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array('jquery'), '1.8.6');
	wp_enqueue_script('custom-scroll', get_template_directory_uri() . '/js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), '1.8.6');
	wp_enqueue_script( 'myfunctions2',  get_template_directory_uri() . '/js/wysihtml5-0.3.0.js',array('jquery'),'1.0' );
	wp_enqueue_script( 'myfunctions',  get_template_directory_uri() . '/js/main.js',array('jquery','myfunctions2'),'1.0' );
	$params = array(
  'foo' => 'bar',
  'setting' => 123,
);
	wp_localize_script( 'myfunctions', 'MyScriptParams', $params );
	// wp_register_style() example
	wp_register_style('style', get_template_directory_uri() . '/style.css');
	  wp_register_style('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css');
	wp_enqueue_style( 'jquery-ui' );

	wp_enqueue_style( 'style' );

	wp_enqueue_script( 'bp-jquery-query' );
	wp_enqueue_script( 'bp-jquery-cookie' );

	wp_enqueue_script( 'bp-jquery-query' );
	wp_enqueue_script( 'bp-jquery-cookie' );

	// Enqueue scrollTo only on activity pages
	if ( bp_is_activity_component() ) {
		wp_enqueue_script( 'bp-jquery-scroll-to' );
	}

	// A similar check is done in BP_Core_Members_Widget, but due to a load order
	// issue, we do it again here
	if ( is_active_widget( false, false, 'bp_core_members_widget' ) && ! is_admin() && ! is_network_admin() ) {
		wp_enqueue_script( 'bp-widget-members' );
	}

	// Enqueue the global JS - Ajax will not work without it
	wp_enqueue_script( 'dtheme-ajax-js', get_template_directory_uri() . '/_inc/global.js', array( 'jquery' ), bp_get_version() );

	// Add words that we need to use in JS to the end of the page so they can be translated and still used.
	$params = array(
		'my_favs'           => __( 'My Favorites', 'buddypress' ),
		'accepted'          => __( 'Accepted', 'buddypress' ),
		'rejected'          => __( 'Rejected', 'buddypress' ),
		'show_all_comments' => __( 'Show all comments for this thread', 'buddypress' ),
		'show_x_comments'   => __( 'Show all %d comments', 'buddypress' ),
		'show_all'          => __( 'Show all', 'buddypress' ),
		'comments'          => __( 'comments', 'buddypress' ),
		'close'             => __( 'Close', 'buddypress' ),
		'view'              => __( 'View', 'buddypress' ),
		'mark_as_fav'	    => __( 'Favorite', 'buddypress' ),
		'remove_fav'	    => __( 'Remove Favorite', 'buddypress' ),
		'unsaved_changes'   => __( 'Your profile has unsaved changes. If you leave the page, the changes will be lost.', 'buddypress' ),
	);
	wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );

	// Maybe enqueue comment reply JS
	if ( is_singular() && bp_is_blog_page() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
	

	wp_localize_script( 'dtheme-ajax-js', 'BP_DTheme', $params );

}
add_action( 'wp_enqueue_scripts', 'victoriacolectiva_scripts' );



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
			pippin_errors()->add('empty_username', __('Correo electrónico no válido'));
		}
 
		if(!isset($_POST['pippin_user_pass']) || $_POST['pippin_user_pass'] == '') {
			// if no password was entered
			pippin_errors()->add('empty_password', __('Por favor inserte una contraseña'));
		}
 
		// check the user's login with their password
		if(!wp_check_password($_POST['pippin_user_pass'], $user->user_pass, $user->ID)) {
			// if the password is incorrect for the specified user
			pippin_errors()->add('empty_password', __('contraseña incorrecta'));
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
   update_user_meta( $user_id, 'init','1');
   
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




function bp_remove_group_step_invites() {

	global $bp;
	//print_r($bp->groups->group_creation_steps);
	unset( $bp->groups->group_creation_steps['group-cover-image'] );
	unset( $bp->groups->group_creation_steps['group-invites'] );
	
}
add_action( 'bp_init', 'bp_remove_group_step_invites', 9999 ); 




/*no jode */

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

// modifica el meta user despues que se modificó 
function activarUsuario( $field_id, $value ) {
	$user_id = get_current_user_id();
	$init =  get_user_meta($user_id,'init');
	if($init[0]=="1"){
		update_user_meta( $user_id, 'init','0');
	}
//…
}
add_action( 'xprofile_profile_field_data_updated', 'activarUsuario');


function my_enqueue_stuff() {
	$url = $_SERVER["REQUEST_URI"];
	$register = strpos($url, 'registrar');
	$mapeo = strpos($url, 'mapeo');
	  if ($register!==false || $mapeo!==false) {
	   wp_enqueue_script('google-map-api','https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyChYCQ7TAvJC6E_I4XCnEuOTDuOV-_lOWY&libraries=places&'); 
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css'); 
	}
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_stuff' );


if ( function_exists('register_sidebar') ){
  	register_sidebar(array(
	    'name' => 'Barra derecha',
	    'before_widget' => '<div class = "widgetizedArea">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2>',
	    'after_title' => '</h2>',
	  )
	);

  	register_sidebar(array(
	    'name' => 'Area superior',
	    'before_widget' => '<div class = "widgetizedArea">',
	    'after_widget' => '</div>',
	    'before_title' => '<h2>',
	    'after_title' => '</h2>',
	  	)
	);
}



function register_my_menu() {
  register_nav_menus(
  	array(
  		'quiero-menu' => __( 'Menú Quiero' ),
  		'hacer-menu' => __( 'Menú Hacer' ),
  		)
  	);
}
add_action( 'init', 'register_my_menu' );


add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'selected ';
    }
    return $classes;
}

add_action('init','possibly_redirect');

function possibly_redirect(){
 global $pagenow;
 if (( 'wp-login.php' == $pagenow ) && (!is_user_logged_in())) {
  wp_redirect('http://hagamos.ciudadfutura.com.ar/');
  exit();
 }
}

/*jode*/
function user_role_update( $user_id, $new_role ) {
		if($new_role=="organico"){
	        $site_url = get_bloginfo('wpurl');
	        $user_info = get_userdata( $user_id );
	        $to = $user_info->user_email;
	        $subject = "Ya sos miembro orgánico";
	        $message = "¡Bienvenido ".$user_info->display_name ."! A partir de ahora podrás acceder a la información completa de la Red Social “Hagamos”, ya que has sido incluido como miembro orgánico de Ciudad Futura. \n\nContinuemos construyendo hoy la sociedad que queremos para mañana.";
	        wp_mail($to, $subject, $message);
        }
}
add_action( 'set_user_role', 'user_role_update', 10, 2);

add_filter('style_loader_tag', 'development_disable_style_caching');
function development_disable_style_caching($tag){
	$fecha = filemtime( get_stylesheet_directory() . '/style.css' ) ;
	return str_replace(get_bloginfo('version'), $fecha, $tag);
}

/*una custom var de la version para que no se  cachee el js*/
function wpse215386_remove_script_version( $src ){
  $parts = explode( '?ver', $src );
  $fecha = filemtime( get_template_directory() . '/js/main.js' ) ;
  return $parts[0].'?ver='.$fecha;
}
// for .js files
add_filter( 'script_loader_src', 'wpse215386_remove_script_version', 15, 1 );


function filtering_activity_default( $query ) {
  if ( empty( $query ) && empty( $_POST ) ) {
    $query = 'action=activity_update';
  }
  return $query;
}
add_filter( 'bp_ajax_querystring', 'filtering_activity_default', 999 );


function fred_whitelist_tags_in_activity( $allowedtags ) {
	    $allowedtags['div']['class'] = array();
	    $allowedtags['h5'] = array();
	    $allowedtags['iframe']['src'] = array();
	    $allowedtags['small'] = array();
	    $allowedtags['h2'] = array();
	    $allowedtags['p']['class'] = array();
	    return $allowedtags;
}
add_filter( 'bp_activity_allowed_tags', 'fred_whitelist_tags_in_activity' );



//$install_path = get_home_path();
$path =ABSPATH.'/wp-content/themes/victoriacolectiva';
require_once( $path . '/includes/custom-event-post.php');
require_once( $path . '/includes/custom-ahora-post.php');
require_once( $path . '/includes/quiero-ayudar.php');
require_once( $path . '/includes/quiero-mapeo.php');
require_once( $path . '/includes/quiero-ser-parte.php');
require_once( $path . '/includes/widget-ahora-en-ciudad-futura.php');
require_once( $path . '/includes/contenido-destacado.php');



