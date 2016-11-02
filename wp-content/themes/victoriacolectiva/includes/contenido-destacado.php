<?php
register_post_type( 'contenido-destacado',
		array(
			'labels' => array(
				'name' => __( 'Contenido Destacado' ),
				'singular_name' => __( 'contenido destacado' ),
				'add_new' => __( 'Agregar nuevo contenido destacado' ),
				'add_new_item' => __( 'Agregar nuevo contenido destacado' ),
				'edit_item' => __( 'Editar nuevo contenido destacado' ),
				'new_item' => __( 'Agregar nuevo contenido destacado' ),
				'view_item' => __( 'Ver contenido destacado' ),
				'search_items' => __( 'Buscar contenido destacado' ),
				'not_found' => __( 'No se encontraron conteindos' ),
				'not_found_in_trash' => __( 'No contenidos found in trash' )
			),
			'public' => true,
			'supports' => array( 'title','editor'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "contenido-destacado"), // Permalinks format
			'menu_position' => 7,
			'register_meta_box_cb' => 'add_destacados_metaboxes'
		)
);


function autor() {
	global $post;
	$autor = get_post_meta($post->ID, '_autor', true);
	echo '<input type="text" name="_autor" id="_autor" value="' . $autor  . '" />';
}

function vinculo(){
	global $post;
	$vinculo = get_post_meta($post->ID, '_vinculo', true);
	echo '<input type="text" name="_vinculo" id="_vinculo" value="' . $vinculo  . '" />';	
}

function add_destacados_metaboxes(){
	add_meta_box('autor', 'Autor', 'autor', 'contenido-destacado', 'normal', 'high');
	add_meta_box('vinculo', 'Link', 'vinculo', 'contenido-destacado', 'normal', 'high');
}

function apf_addpost() {
    $results = '';
 
    $title = $_POST['apftitle'];
    $content =  $_POST['apfcontents'];
    $autor = $_POST['autor'];
    $vinculo = $_POST['vinculo'];
 
    $post_id = wp_insert_post( array(
        'post_title'        => $title,
        'post_content'      => $content,
        'post_status'       => 'publish',
        'post_author'       => '1',
        'post_type' 		=> 'contenido-destacado'
    ) );
 	
 	update_post_meta($post_id,'_autor',$autor);
	update_post_meta($post_id,'_vinculo',$vinculo);
    
    if ( $post_id != 0 )
    {
        $results = '*Post Added';
    }
    else {
        $results = '*Error occurred while adding the post';
    }
    // Return the String
    die($results);
}

// creating Ajax call for WordPress
add_action( 'wp_ajax_nopriv_apf_addpost', 'apf_addpost' );
add_action( 'wp_ajax_apf_addpost', 'apf_addpost' );

function apf_enqueuescripts()
{
	if ( current_user_can('administrator') ){
		wp_enqueue_script( 'admin',  get_template_directory_uri() . '/js/gestion.js',array('jquery'),'1.0' );
    	wp_localize_script( 'admin', 'apfajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }
}
add_action('wp_enqueue_scripts', 'apf_enqueuescripts');