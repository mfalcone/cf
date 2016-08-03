<?php
if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );


function doctype_opengraph($output) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');


function fb_opengraph() {
    global $post;
 
    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
        } else {
            $img_src = get_stylesheet_directory_uri() . '/img/ciudad_hacer.jpg';
        }
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
        ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
 
<?php
    } else if(is_page()){
     if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'large');
        } else {
            $img_src = get_stylesheet_directory_uri() . '/img/ciudad_hacer.png';
        }	
    ?>	

	
	<meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src[0]; ?>"/>

<?php

    } else {

        return;
    }
}

add_action('wp_head', 'fb_opengraph', 5);

function wpt_posicion() {
  global $post;
  echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
  $posibles_posiciones =  array('_baja','_media','_alta','_fuego');
  $posibles_labels =  array('Baja','Media','Alta','Fuego');
  
  $posicion = get_post_meta($post->ID, '_posicion', true);
  $index = 0;
  echo '<select size="1" name="_posicion" id="_posicion">';
   foreach($posibles_posiciones as $opt)
   {
    $selected = ($opt === $posicion) ? ' selected="selected"' : '';
    echo '<option value="'.$opt.'" name="'.$opt.'" '.$selected.'>'.$posibles_labels[$index].'</option>';
    $index++;
    }
echo '</select>';

}

function add_posiciones_metaboxes() {
  add_meta_box('wpt_posicion', 'Estado', 'wpt_posicion','post');
}

add_action( 'add_meta_boxes', 'add_posiciones_metaboxes' );



function wpt_save_estados_meta($post_id, $post) {
  
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
  return $post->ID;
  }

  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID ))
    return $post->ID;

  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
  
  $proyectos_meta['_posicion'] = $_POST['_posicion'];
  
  // Add values of $events_meta as custom fields
  
  foreach ($proyectos_meta as $key => $value) { // Cycle through the $events_meta array!
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



function noticias_en_los_barrios() {
  register_post_type( 'seccionales',
    array(
      'labels' => array(
        'name' => __( 'Ciudad Futura en los barrios' ),
        'singular_name' => __( 'noticias del mes en las seccionales' ),
        'add_new' => __( 'Agregar Noticia sobre seccionales' ),
        'add_new_item' => __( 'Agregar Noticia sobre seccionales' ),
        'edit_item' => __( 'Editar Noticia sobre seccionales' ),
        'new_item' => __( 'Agregar Noticia sobre seccionales' ),
        'view_item' => __( 'ver Noticia sobre seccionales' ),
        'search_items' => __( 'Buscar Noticia sobre seccionales' ),
        'not_found' => __( 'No se encontraron  Noticia sobre seccionales' ),
        'not_found_in_trash' => __( 'No Noticias found in trash' )
      ),
      'public' => true,
      'supports' => array( 'title','custom-fields','thumbnail' ),
      'capability_type' => 'post',
      'rewrite' => array("slug" => "noticias-en-las-seccionales"), // Permalinks format
      'menu_position' => 5,
      'show_ui' => true,
    //'show_in_menu' => 'my-shop',
    )
  );
};

add_action( 'init', 'noticias_en_los_barrios' );


add_action('save_post', 'wpt_save_estados_meta', 1, 2); // save the custom fieldsx<

add_action( 'after_setup_theme', 'setup' );

function setup() {
    // ...
     
    add_image_size( 'alta-image', 409, 306, true );
    add_image_size( 'media-image', 230, 136, true );
     
    // ...
}


// load css into the website's front-end
function mytheme_enqueue_style() {
    wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() ); 
    wp_deregister_script('jquery');
    wp_register_script('jquery',get_template_directory_uri() . '/js/jquery-2.2.0.min.js' , false, null);
    wp_enqueue_script('jquery');
    wp_register_script('my_amazing_script', get_template_directory_uri() . '/js/hacer.js', array('jquery'),'1.1', true);
    wp_enqueue_script('my_amazing_script');

}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_style' );



?>