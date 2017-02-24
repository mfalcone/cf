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
            $img_src_ar = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
            $img_src = $img_src_ar[0];  
        } else {
            $img_src = get_stylesheet_directory_uri() . '/img/portada.jpg';
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
            $img_src = get_stylesheet_directory_uri() . '/img/portada.jpg';
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
      $img_src = get_stylesheet_directory_uri() . '/img/portada.jpg';
    
    ?>
    <meta property="og:title" content="2016.ciudadfutura.com.ar"/>
    <meta property="og:description" content="2016.ciudadfutura.com.ar es un resumen de las activdades más destacadas del año legislativo que se presentan aquí en el marco de los conceptos de Transparencia y Hacer."/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="http://2016.ciudadfutura.com.ar"/>
    <meta property="og:site_name" content="2016.ciudadfutura.com.ar""/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
    <?php
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


function wpt_layout() {
  global $post;
  $layout = get_post_meta($post->ID, 'layout', true);
  echo '<input type="hidden" name="eventmeta_noncename" id="layoutmeta_noncename" value="' . 
  wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
  $posibilidades = array('main','dos-columnas');
  $labeles = array('Columna Principal','Dos Columnas');
  $indice = 0;
  foreach($posibilidades as $opciones){
    $checked = ($opciones===$layout) ? 'checked':'';
      echo '<input type="radio" name="layout" value="'.$opciones.'" '.$checked.'>'.$labeles[$indice].'<br>';
      $indice++;
  }

}

function add_layout_metaboxes() {
  add_meta_box('wpt_layout', 'Layout', 'wpt_layout','post');
}


add_action( 'add_meta_boxes', 'add_layout_metaboxes' );




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
  $proyectos_meta['layout'] = $_POST['layout'];
  
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
    wp_register_script('fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js', array('jquery'),false, false);
    wp_enqueue_script('fancybox');
    wp_register_script('my_amazing_script', get_template_directory_uri() . '/js/hacer.js', array('jquery'),false,false);
    wp_enqueue_script('my_amazing_script');

}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_style' );


/**
 * Custom WP gallery
 */
add_shortcode('gallery', 'my_gallery_shortcode');    
function my_gallery_shortcode($attr) {
   $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
      // 'ids' is explicitly ordered, unless you specify otherwise.
      if ( empty( $attr['orderby'] ) )
          $attr['orderby'] = 'post__in';
      $attr['include'] = $attr['ids'];
  }

  // Allow plugins/themes to override the default gallery template.
  $output = apply_filters('post_gallery', '', $attr);
  if ( $output != '' )
      return $output;

  // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
  if ( isset( $attr['orderby'] ) ) {
      $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
      if ( !$attr['orderby'] )
          unset( $attr['orderby'] );
  }

  extract(shortcode_atts(array(
      'order'      => 'ASC',
      'orderby'    => 'menu_order ID',
      'id'         => $post->ID,
      'itemtag'    => 'li',
      'icontag'    => 'figure',
      'captiontag' => 'figcaption',
      'columns'    => 3,
      'size'       => 'thumbnail',
      'include'    => '',
      'exclude'    => ''
  ), $attr));

  $id = intval($id);
  if ( 'RAND' == $order )
      $orderby = 'none';

  if ( !empty($include) ) {
      $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

      $attachments = array();
      foreach ( $_attachments as $key => $val ) {
          $attachments[$val->ID] = $_attachments[$key];
      }
  } elseif ( !empty($exclude) ) {
      $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  } else {
      $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  }

  if ( empty($attachments) )
      return '';

  if ( is_feed() ) {
      $output = "\n";
      foreach ( $attachments as $att_id => $attachment )
          $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
      return $output;
  }

  $itemtag = tag_escape($itemtag);
  $captiontag = tag_escape($captiontag);
  $icontag = tag_escape($icontag);
  $valid_tags = wp_kses_allowed_html( 'post' );
  if ( ! isset( $valid_tags[ $itemtag ] ) )
      $itemtag = 'li';
  if ( ! isset( $valid_tags[ $captiontag ] ) )
      $captiontag = 'figcaption';
  if ( ! isset( $valid_tags[ $icontag ] ) )
      $icontag = 'figure';

  $columns = intval($columns);
  $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
  $float = is_rtl() ? 'right' : 'left';

  $selector = "gallery-{$instance}";

  $gallery_style = $gallery_div = '';
  if ( apply_filters( 'use_default_gallery_style', true ) )
      
  $size_class = sanitize_html_class( $size );
  $gallery_div = "<ul id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
  $output = $gallery_div;//apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

  $i = 0;
  foreach ( $attachments as $id => $attachment ) {
      $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

      $output .= "<{$itemtag} class='gallery-item col-md-4'>";
      $output .= "
          <{$icontag} class='gallery-icon'>
              $link
          </{$icontag}>";
      if ( $captiontag && trim($attachment->post_excerpt) ) {
          $output .= "
              <{$captiontag} class='wp-caption-text gallery-caption'>
              " . wptexturize($attachment->post_excerpt) . "
              </{$captiontag}>";
      }
      $output .= "</{$itemtag}>";
      if ( $columns > 0 && ++$i % $columns == 0 )
          $output .= '<br style="clear: both" />';
  }

  $output .= "
          <br style='clear: both;' />
      </ul>\n";

  return $output;
}