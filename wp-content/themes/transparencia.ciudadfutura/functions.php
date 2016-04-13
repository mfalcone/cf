<?


/*
  nuevo admin menu
*/

//add_action('admin_menu', 'ms_create_admin_menu');

function ms_create_admin_menu() {
    add_menu_page('Mis Custom post', 'Mis custom posts', 'manage_options', 'my-shop', 'my_shop_order_log');
}



/*
* Creating a function Custom Post Type
*/

// Registers the new post type and taxonomy

function wpt_event_posttype() {
  register_post_type( 'movimientos',
    array(
      'labels' => array(
        'name' => __( 'Movimientos' ),
        'singular_name' => __( 'Movimiento' ),
        'add_new' => __( 'Agregar Movimiento ' ),
        'add_new_item' => __( 'Agregar Nuevo Movimiento' ),
        'edit_item' => __( 'Editar Movimiento' ),
        'new_item' => __( 'Agregar Nuevo Movimiento' ),
        'view_item' => __( 'ver Movimiento' ),
        'search_items' => __( 'Buscar Movimiento' ),
        'not_found' => __( 'No se encontraron movimientos' ),
        'not_found_in_trash' => __( 'No movimientos found in trash' )
      ),
      'public' => true,
      'supports' => array( 'title','custom-fields','thumbnail' ),
      'capability_type' => 'post',
      'rewrite' => array("slug" => "movimientos"), // Permalinks format
      'menu_position' => 5,
      //'register_meta_box_cb' => 'add_events_metaboxes',
      'show_ui' => true,
    //'show_in_menu' => 'my-shop',
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