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
  $posibles_posiciones =  array('_baja','_media','_alta','_fuego');
  $posibles_labels =  array('Baja','Media','Alta','Fuego');
  
  $posicion = get_post_meta($post->ID, '_posicion', true);
  $index = 0;
  echo '<select size="1" name="_posicion" id="t3">';
   foreach($posibles_posiciones as $opt)
   {
    $selected = ($opt === $posicion) ? ' selected="selected"' : '';
    echo '<option value="'.$opt.'" name="'.$opt.'" '.$selected.'>'.$posibles_labels[$index].'</option>';
    $index++;
    }
echo '</select>';

}

function add_posiciones_metaboxes() {
  add_meta_box('wpt_posicion', 'Estado', 'wpt_posicion');
}

add_action( 'add_meta_boxes', 'add_posiciones_metaboxes' );



function wpt_save_estados_meta($post_id, $post) {
  
  // verify this came from the our screen and with proper authorization,
  // because save_post can be triggered at other times
  if ( !wp_verify_nonce( $_POST['eventmeta_noncename_proyecto'], plugin_basename(__FILE__) )) {
  return $post->ID;
  }

  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID ))
    return $post->ID;

  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
  
  $proyectos_meta['_proyecto'] = $_POST['_proyecto'];
  $proyectos_meta['_titulo'] = $_POST['_titulo'];
  $proyectos_meta['_autor'] = $_POST['_autor'];
  $proyectos_meta['_estado'] = $_POST['_estado'];
  $proyectos_meta['_file'] = $_POST['_file'];
  
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


add_action('save_post', 'wpt_save_estados_meta', 1, 2); // save the custom fieldsx<




?>