<?php


register_post_type( 'propuesta',
		array(
			'labels' => array(
				'name' => __( 'propuestas' ),
				'singular_name' => __( 'propuesta' ),
				'add_new' => __( 'Agregar nueva propuesta' ),
				'add_new_item' => __( 'Agregar nueva propuesta' ),
				'edit_item' => __( 'Editar propuesta' ),
				'new_item' => __( 'Agregar nueva propuesta' ),
				'view_item' => __( 'Ver propuesta' ),
				'search_items' => __( 'Buscar propuesta' ),
				'not_found' => __( 'No se encontraron propuestas' ),
				'not_found_in_trash' => __( 'No propuestas found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'thumbnail'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "propuesta"), // Permalinks format
			'menu_position' => 8,
			'register_meta_box_cb' => 'add_propuestas_metaboxes'
		)
	);



function add_propuestas_metaboxes(){
	add_meta_box('wpt_que_es', 'Que es', 'wpt_que_es', 'propuesta', 'normal', 'high');
	add_meta_box('wpt_para_que_sirve', 'Para que sirve', 'wpt_para_que_sirve', 'propuesta', 'normal', 'high');
	add_meta_box('wpt_ejemplo', 'Ejemplo', 'wpt_ejemplo', 'propuesta', 'normal', 'high');
	add_meta_box('wpt_link_ordenanza', 'link al proyecto de Ordenanza', 'wpt_link_ordenanza', 'propuesta', 'normal', 'high');
}


function wpt_que_es() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename_concejal" id="eventmeta_noncename_concejal" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	$que_es = get_post_meta($post->ID, '_que_es', true);
	 wp_editor( $que_es, '_que_es', array(
		'wpautop'       => true,
		'textarea_name' => '_que_es',
		'textarea_rows' => 10,
		'teeny'         => true
	) );
}

function wpt_para_que_sirve() {
	global $post;
	$para_que_sirve = get_post_meta($post->ID, '_para_que_sirve', true);
	 wp_editor( $para_que_sirve, '_para_que_sirve', array(
		'wpautop'       => true,
		'textarea_name' => '_para_que_sirve',
		'textarea_rows' => 10,
		'teeny'         => true
	) );
}

function wpt_ejemplo() {
	global $post;
	$para_que_sirve = get_post_meta($post->ID, '_ejemplo', true);
	 wp_editor( $para_que_sirve, '_ejemplo', array(
		'wpautop'       => true,
		'textarea_name' => '_ejemplo',
		'textarea_rows' => 10,
		'teeny'         => true
	) );
}


function wpt_link_ordenanza() {
	global $post;
	$link_ordenanza = get_post_meta($post->ID, '_link_ordenanza', true);
	echo '<input type="text" name="_link_ordenanza" value="' . $link_ordenanza  . '" class="widefat" />';
}


function wpt_save_propuestas_meta($post_id, $post) {
	
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename_concejal'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	
	$que_es['_que_es'] = $_POST['_que_es'];
	$que_es['_para_que_sirve'] = $_POST['_para_que_sirve'];
	$que_es['_ejemplo'] = $_POST['_ejemplo'];
	$que_es['_link_ordenanza'] = $_POST['_link_ordenanza'];
	
	foreach ($que_es as $key => $value) { // Cycle through the $events_meta array!
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


add_action('save_post', 'wpt_save_propuestas_meta', 1, 2); // save the custom fieldsx<

function estilosyjs()  { 

	wp_enqueue_style('style.css', get_stylesheet_directory_uri() . '/style.css');
	wp_enqueue_script('jquery');
	wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), 1.0, false );
	
	
}
add_action( 'wp_enqueue_scripts', 'estilosyjs' );

if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );


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
   } ?>	

	
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
