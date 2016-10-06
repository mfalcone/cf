<?

register_post_type( 'ahora',
		array(
			'labels' => array(
				'name' => __( 'Ahora en Ciudad Ftura' ),
				'singular_name' => __( 'Ahora en Ciudad Futura' ),
				'add_new' => __( 'Agregar nueva noticia' ),
				'add_new_item' => __( 'Agregar nueva noticia' ),
				'edit_item' => __( 'Editar noticia' ),
				'new_item' => __( 'Agregar nueva Noticia' ),
				'view_item' => __( 'Ver Noticia' ),
				'search_items' => __( 'Buscar noticia' ),
				'not_found' => __( 'No se encontraron noticias' ),
				'not_found_in_trash' => __( 'No noticias found in trash' )
			),
			'public' => true,
			'supports' => array( 'title'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "ahora"), // Permalinks format
			'menu_position' => 7
			//'register_meta_box_cb' => 'add_eventos_metaboxes'
		)
	);


