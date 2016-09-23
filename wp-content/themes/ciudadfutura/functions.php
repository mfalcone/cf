<?php
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Menu principal' ),
      'social-menu' => __( 'Social Menu' ),
    )
  );
}
add_action( 'init', 'register_my_menus' );


class Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= '<div class="subwrap"><div class="imageicon"></div><div class="sub"><h2>'.$item->title .'</h2>'. $item->description . '</div>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el(&$output, $item, $depth=0, $args=array()) {
        $output .= "</div></li>\n";
    }

	function start_lvl(&$output, $depth) {
		    $indent = str_repeat("\t", $depth);
		    $output .= "\n$indent<ul class=\"sub-menu level-".$depth."\">\n";
		}
}

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
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'large');
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
    <meta property="og:image" content="<?php echo $img_src[0]; ?>"/>
 
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


/*Creacion de la admin page */

add_action( 'admin_menu', 'wpse_91693_register' );

function wpse_91693_register()
{
    add_menu_page(
        'Directorio de Militantes',     // page title
        'Sumate',     // menu title
        'manage_options',   // capability
        'include-text',     // menu slug
        'wpse_91693_render' // callback function
    );
}
function wpse_91693_render()
{
    global $title;
    global $wpdb;

    //$file = plugin_dir_path( __FILE__ ) . "included.html";

    include( get_template_directory() . '/includes/militantes.php');

    //if ( file_exists( $file ) )
     //   require $file;

}

     add_action( 'wp_enqueue_scripts', 'ajax_test_enqueue_scripts' );


function ajax_test_enqueue_scripts() {
 if (is_category('actualizaciones'))    {
    is_category( 'Stinky Cheeses' );
    wp_register_script('love', get_template_directory_uri() . '/js/actualizaciones.js', array('jquery'),'1.1', true);
    wp_localize_script( 'love', 'postlove', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'query_vars' => json_encode( $wp_query->query )
    ));

    wp_enqueue_script('love');
    }
}

add_action( 'wp_ajax_nopriv_post_love_add_love', 'post_love_add_love' );
add_action( 'wp_ajax_post_love_add_love', 'post_love_add_love' );

function post_love_add_love() {
        $count = $_REQUEST["count"];
        $args = array(
            'category_name' => 'actualizaciones', 
            'posts_per_page' => 6, 
            'paged' => $count
            );

        $query = new WP_Query( $args );
        $actualizaciones = array();

        while( $query->have_posts() ) : $query->the_post();
 
          // Add a car entry
        $thumbID = get_post_thumbnail_id( get_the_id() );
        $imgDestacada = wp_get_attachment_url( $thumbID );

          $actualizaciones[] = array(
            'titulo'    => get_the_title(),
            'excerpt'   => get_the_excerpt(),
            'id'        => get_the_id(),
            'imagen'    => $imgDestacada,
            'link'      => get_permalink()
          );
       
        endwhile;
        wp_reset_query();
        echo json_encode( $actualizaciones );
        die();
}

function wpb_mce_buttons_2($buttons) {
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'wpb_mce_buttons_2');

/*
* Callback function to filter the MCE settings
*/

function my_mce_before_init_insert_formats( $init_array ) {  

// Define the style_formats array

    $style_formats = array(  
        // Each array child is a format with it's own settings
        array(  
            'title' => 'Content Block',  
            'block' => 'span',  
            'classes' => 'content-block',
            'wrapper' => true,
            
        ),  
        array(  
            'title' => 'Blue Button',  
            'block' => 'span',  
            'classes' => 'blue-button',
            'wrapper' => true,
        ),
        array(  
            'title' => 'Red Button',  
            'block' => 'span',  
            'classes' => 'red-button',
            'wrapper' => true,
        ),
    );  
    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode( $style_formats );  
    
    return $init_array;  
  
} 
// Attach callback to 'tiny_mce_before_init' 
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' ); 


// agrego los estilos al wp editor
add_filter( 'mce_css', 'fb_mcekit_editor_style');
function fb_mcekit_editor_style($url) {

    if ( ! empty( $url ) )
        $url .= ',';

    // Retrieves the plugin directory URL
    // Change the path here if using different directories
    $url .= trailingslashit( plugin_dir_url( __FILE__ ) ) . '/my-editor-styles.css';

    return $url;
}



?>