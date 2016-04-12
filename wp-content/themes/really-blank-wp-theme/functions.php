<?

/*
* Remove actions
* Add a // to the start of the line to comment and enable the action by default
*/
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_filter( 'the_content', 'capital_P_dangit' );
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'comment_text', 'capital_P_dangit' );
remove_filter('atom_service_url','atom_service_url_filter');
//remove_action('wp_head', 'index_rel_link');
//remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
//remove_filter('the_content', 'wptexturize');
//remove_filter('comment_text', 'wptexturize');

function custom_disable_embeds_init() {
  // Remove the REST API endpoint.
  remove_action('rest_api_init', 'wp_oembed_register_route');
  // Turn off oEmbed auto discovery.
  // Don't filter oEmbed results.
  remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
  // Remove oEmbed discovery links.
  remove_action('wp_head', 'wp_oembed_add_discovery_links');
  // Remove oEmbed-specific JavaScript from the front-end and back-end.
  remove_action('wp_head', 'wp_oembed_add_host_js');
}

add_action('init', 'custom_disable_embeds_init', 9999);

/* remove inline recent comments */
// <style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style> added in the header
function remove_recent_comment_style() {
	global $wp_widget_factory;
	remove_action(
    'wp_head',
    array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' )
  );
}
add_action( 'widgets_init', 'remove_recent_comment_style' );

/* disable feeds and rss */
$feedDisabled = true;
if ($feedDisabled) :

  function disableFeed () {
    wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
  }

  add_action('do_feed', 'fb_disable_feed', 1);
  add_action('do_feed_rdf', 'fb_disable_feed', 1);
  add_action('do_feed_rss', 'fb_disable_feed', 1);
  add_action('do_feed_rss2', 'fb_disable_feed', 1);
  add_action('do_feed_atom', 'fb_disable_feed', 1);
  add_action('do_feed_rss2_comments', 'fb_disable_feed', 1);
  add_action('do_feed_atom_comments', 'fb_disable_feed', 1);
endif;


if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'before_title' => '<h3>',
    'after_title' => '</h3>',
    'before_widget' => '',
    'after_widget' => ''
  )
);

function date_post() {
  echo "hace " . human_time_diff( get_the_time('U'), current_time( 'timestamp' ) );
}

if (!isset($content_width))
  $content_width = 900;

/* Add Menu Support */
add_theme_support('menus');
function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
}
add_action( 'init', 'register_my_menu' );

/* Add Thumbnail Theme Support */
add_theme_support('post-thumbnails');
//add_image_size('large', 700, '', true); // Large Thumbnail
//add_image_size('medium', 250, '', true); // Medium Thumbnail
//add_image_size('small', 120, '', true); // Small Thumbnail
//add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');


/*
  nuevo admin menu
*/

add_action('admin_menu', 'ms_create_admin_menu');

function ms_create_admin_menu() {
    add_menu_page('Mis Custom post', 'Mis custom posts', 'manage_options', 'my-shop', 'my_shop_order_log');
}



/*
* Creating a function Custom Post Type
*/

// Registers the new post type and taxonomy

function wpt_event_posttype() {
  register_post_type( 'events',
    array(
      'labels' => array(
        'name' => __( 'Eventos' ),
        'singular_name' => __( 'Evento' ),
        'add_new' => __( 'Agregar Nuevo ' ),
        'add_new_item' => __( 'Agregar Nuevo Evento' ),
        'edit_item' => __( 'Edit Evento' ),
        'new_item' => __( 'Add New Event' ),
        'view_item' => __( 'View Event' ),
        'search_items' => __( 'Search Event' ),
        'not_found' => __( 'No events found' ),
        'not_found_in_trash' => __( 'No events found in trash' )
      ),
      'public' => true,
      'supports' => array( 'title','thumbnail' ),
      'capability_type' => 'post',
      'rewrite' => array("slug" => "events"), // Permalinks format
      'menu_position' => 5,
      'register_meta_box_cb' => 'add_events_metaboxes',
      'show_ui' => true,
    'show_in_menu' => 'my-shop',
    )
  );
  flush_rewrite_rules();

}

add_action( 'init', 'wpt_event_posttype' );


/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/


// The Event Location Metabox

function wpt_events_location() {
  global $post;
  $location = get_post_meta($post->ID, '_location', true);
  echo '<input type="text" name="_location" id="_location" value="' . $location . '" />';
}

function wpt_events_date(){
   global $post;
  $date = get_post_meta($post->ID, '_date', true);
  echo '<input type="text" name="_date" id="_date" value="' . $date . '" />'; 
}

// Add the Events Meta Boxes

function add_events_metaboxes() {
  add_meta_box('wpt_events_location', 'Lugar del Evento', 'wpt_events_location', 'events', 'normal', 'default');
  add_meta_box('wpt_events_date', 'Fecha del Evento', 'wpt_events_date', 'events', 'normal', 'default');
}


/*custom fields*/

add_action( 'add_meta_boxes', 'add_events_metaboxes' );



// Save the Metabox Data

function wpt_save_events_meta($post_id, $post) {
  
  
  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID ))
    return $post->ID;

  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
  
  $events_meta['_location'] = $_POST['_location'];
  $events_meta['_date'] = $_POST['_date'];
  
  // Add values of $events_meta as custom fields
  
  foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
    if( $post->post_type == 'revision' ) return; // Don't store custom data twice
    $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
    if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
      update_post_meta($post->ID, $key, $value);
    } else { // If the custom field doesn't have a value
      add_post_meta($post->ID, $key, $value);
    }
    if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
  }

}

add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fields