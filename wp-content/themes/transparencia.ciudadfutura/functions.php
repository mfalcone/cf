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
			'show_ui' => true,
		//'show_in_menu' => 'my-shop',
		)
	);

	register_post_type( 'subsidios',
		array(
			'labels' => array(
				'name' => __( 'Subsidio' ),
				'singular_name' => __( 'Subsidio' ),
				'add_new' => __( 'Agregar nuevo subsidio' ),
				'add_new_item' => __( 'Agregar nuevo subsidio' ),
				'edit_item' => __( 'Editar Subsidio' ),
				'new_item' => __( 'Agregar nuevo subsidio' ),
				'view_item' => __( 'Ver Subsidio' ),
				'search_items' => __( 'Buscar subsidio' ),
				'not_found' => __( 'No se encontraron subsidios' ),
				'not_found_in_trash' => __( 'No subsidios found in trash' )
			),
			'public' => true,
			'supports' => array( 'title',  'thumbnail' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "subsidios"), // Permalinks format
			'menu_position' => 6,
			'register_meta_box_cb' => 'add_subsidios_metaboxes'
		)
	);

register_post_type( 'proyectos',
		array(
			'labels' => array(
				'name' => __( 'Proyectos' ),
				'singular_name' => __( 'Proyecto' ),
				'add_new' => __( 'Agregar nuevo proyecto' ),
				'add_new_item' => __( 'Agregar nuevo proyecto' ),
				'edit_item' => __( 'Editar Proyecto' ),
				'new_item' => __( 'Agregar nuevo proyecto' ),
				'view_item' => __( 'Ver Proyecto' ),
				'search_items' => __( 'Buscar proyecto' ),
				'not_found' => __( 'No se encontraron proyectos' ),
				'not_found_in_trash' => __( 'No proyectos found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'thumbnail','tags'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "proyectos"), // Permalinks format
			'menu_position' => 6,
			'taxonomies' => array('post_tag'),
			'register_meta_box_cb' => 'add_proyectos_metaboxes'
		)
	);


register_post_type( 'agenda',
		array(
			'labels' => array(
				'name' => __( 'Agenda' ),
				'singular_name' => __( 'Evento' ),
				'add_new' => __( 'Agregar nuevo evento' ),
				'add_new_item' => __( 'Agregar nuevo evento' ),
				'edit_item' => __( 'Editar Evento' ),
				'new_item' => __( 'Agregar nuevo Evento' ),
				'view_item' => __( 'Ver Evento' ),
				'search_items' => __( 'Buscar evento' ),
				'not_found' => __( 'No se encontraron eventos' ),
				'not_found_in_trash' => __( 'No eventos found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'thumbnail'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "eventos"), // Permalinks format
			'menu_position' => 7,
			'register_meta_box_cb' => 'add_eventos_metaboxes'
		)
	);


register_post_type( 'respuesta',
		array(
			'labels' => array(
				'name' => __( 'Respuestas' ),
				'singular_name' => __( 'Respuesta' ),
				'add_new' => __( 'Agregar nueva respuesta' ),
				'add_new_item' => __( 'Agregar nueva respuesta' ),
				'edit_item' => __( 'Editar Respuesta' ),
				'new_item' => __( 'Agregar nueva Respuesta' ),
				'view_item' => __( 'Ver Respuesta' ),
				'search_items' => __( 'Buscar respuesta' ),
				'not_found' => __( 'No se encontraron respuestas' ),
				'not_found_in_trash' => __( 'No respuestas found in trash' )
			),
			'public' => true,
			'supports' => array( 'title', 'thumbnail'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "notasclaras"), // Permalinks format
			'menu_position' => 8,
			'register_meta_box_cb' => 'add_respuestas_metaboxes'
		)
	);



register_post_type( 'Personas',
		array(
			'labels' => array(
				'name' => __( 'Personas' ),
				'singular_name' => __( 'Persona' ),
				'add_new' => __( 'Agregar nueva persona' ),
				'add_new_item' => __( 'Agregar nueva persona' ),
				'edit_item' => __( 'Editar persona' ),
				'new_item' => __( 'Agregar nueva persona' ),
				'view_item' => __( 'Ver Persona' ),
				'search_items' => __( 'Buscar persona' ),
				'not_found' => __( 'No se encontraron personas' ),
				'not_found_in_trash' => __( 'No personas found in trash' )
			),
			'public' => true,
			'supports' => array( 'title',  'thumbnail' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "personas"), // Permalinks format
			'menu_position' => 6,
			'register_meta_box_cb' => 'add_personas_metaboxes'
		)
	);


register_post_type( 'Concejales',
		array(
			'labels' => array(
				'name' => __( 'Concejales' ),
				'singular_name' => __( 'Concejal' ),
				'add_new' => __( 'Agregar nuevo concejal' ),
				'add_new_item' => __( 'Agregar nuevo concejal' ),
				'edit_item' => __( 'Editar concejal' ),
				'new_item' => __( 'Agregar nuevo concejal' ),
				'view_item' => __( 'Ver Concejal' ),
				'search_items' => __( 'Buscar Concejal' ),
				'not_found' => __( 'No se encontraron concejales' ),
				'not_found_in_trash' => __( 'No Concejales found in trash' )
			),
			'public' => true,
			'supports' => array( 'title',  'thumbnail' ),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "concejal"), // Permalinks format
			'menu_position' => 6,
			'register_meta_box_cb' => 'add_concejales_metaboxes'
		)
	);

register_post_type( 'votaciones',
		array(
			'labels' => array(
				'name' => __( 'votaciones' ),
				'singular_name' => __( 'votacion' ),
				'add_new' => __( 'Agregar nuevo votacion' ),
				'add_new_item' => __( 'Agregar nuevo votaciones' ),
				'edit_item' => __( 'Editar votaciones' ),
				'new_item' => __( 'Agregar nuevo votaciones' ),
				'view_item' => __( 'Ver votaciones' ),
				'search_items' => __( 'Buscar votaciones' ),
				'not_found' => __( 'No se encontraron votaciones' ),
				'not_found_in_trash' => __( 'No votaciones found in trash' )
			),
			'public' => true,
			'supports' => array( 'title',  'thumbnail' ,'editor'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "votaciones"), // Permalinks format
			'menu_position' => 6,
			'register_meta_box_cb' => 'add_votaciones_metaboxes'
		)
	);


register_post_type( 'barrios',
		array(
			'labels' => array(
				'name' => __( 'barrios' ),
				'singular_name' => __( 'barrios' ),
				'add_new' => __( 'Agregar nuevo Barrio' ),
				'add_new_item' => __( 'Agregar nuevo barrios' ),
				'edit_item' => __( 'Editar barrios' ),
				'new_item' => __( 'Agregar nuevo barrios' ),
				'view_item' => __( 'Ver barrios' ),
				'search_items' => __( 'Buscar barrios' ),
				'not_found' => __( 'No se encontraron barrios' ),
				'not_found_in_trash' => __( 'No barrios found in trash' )
			),
			'public' => true,
			'supports' => array( 'title',  'thumbnail' ,'editor'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "ciudad_futura_en_tu_barrio"), // Permalinks format
			'menu_position' => 6,
			'register_meta_box_cb' => 'add_barrios_metaboxes'
		)
	);

	flush_rewrite_rules();

}

add_action( 'init', 'wpt_event_posttype' );


/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/




function wpt_sesion_date(){
	 global $post;
	$sesion = get_post_meta($post->ID, '_sesion', true);
	echo '<input type="text" name="_sesion" id="_sesion" value="' . $sesion . '" />'; 
}


// The Event Location Metabox

function wpt_institucion() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$location = get_post_meta($post->ID, '_institucion', true);
	
	// Echo out the field
	echo '<input type="text" name="_institucion" value="' . $location  . '" class="widefat" />';

}


// The Event Location Metabox

function wpt_territorio() {
	global $post;
	// Get the location data if its already been entered
	$territorio = get_post_meta($post->ID, '_territorio', true);
	
	// Echo out the field
	echo '<input type="text" name="_territorio" value="' . $territorio  . '" class="widefat" />';

}

function wpt_objetivo() {
	global $post;
	// Get the location data if its already been entered
	$objetivo = get_post_meta($post->ID, '_objetivo', true);
	
	// Echo out the field
	echo '<textarea rows="1" cols="40" name="_objetivo" id="_objetivo" style="width:100%">'.$objetivo.'</textarea>';
}


function wpt_monto(){
	 global $post;
	$monto = get_post_meta($post->ID, '_monto', true);
	echo '<input type="text" name="_monto" id="_monto" value="' . $monto . '" />'; 
}


function add_barrios_metaboxes() {
	add_meta_box('wpt_mapa', 'Insertar Pins en mapa', 'wpt_mapa', 'barrios', 'normal', 'high');
}


function wpt_mapa(){
	 global $post;
	$pins_en_mapa = get_post_meta($post->ID, '_pins_en_proyecto', true);
	echo '<input type="hidden" name="_pins_en_proyecto" id="_pins_en_proyecto" value="' . $pins_en_mapa . '" />'; 
	echo '<div id="mapa"></div>';
}


// Add the Events Meta Boxes

function add_subsidios_metaboxes() {
	add_meta_box('wpt_sesion_date', 'Fecha de sesión', 'wpt_sesion_date', 'subsidios', 'normal', 'high');
	add_meta_box('wpt_institucion', 'Institución', 'wpt_institucion', 'subsidios', 'normal', 'high');
	add_meta_box('wpt_territorio', 'Territorio', 'wpt_territorio', 'subsidios', 'normal', 'high');
	add_meta_box('wpt_objetivo', 'Objetivo', 'wpt_objetivo', 'subsidios', 'normal', 'high');
	add_meta_box('wpt_monto', 'Monto', 'wpt_monto', 'subsidios', 'normal', 'high');
}


function wpt_proyecto_date(){
	 global $post;
	$proyecto = get_post_meta($post->ID, '_proyecto', true);
	echo '<input type="text" name="_proyecto" id="_proyecto" value="' . $proyecto . '" />'; 
}

function wpt_titulo_proyecto() {
	global $post;
	
	echo '<input type="hidden" name="eventmeta_noncename_proyecto" id="eventmeta_noncename_proyecto" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$titulo = get_post_meta($post->ID, '_titulo', true);
	
	echo '<input type="text" name="_titulo" value="' . $titulo  . '" class="widefat" />';

}

function wpt_autor() {
	global $post;
	
	$autor = get_post_meta($post->ID, '_autor', true);
	
	echo '<input type="text" name="_autor" value="' . $autor  . '" class="widefat" />';

}

function wpt_estado() {
	global $post;
	$posibles_estados =  array('_aprobado','_en_comision','_en_archivo','_rechazado','_despacho');
	$posibles_labels =  array('Aprobado','En comisión','En archivo','Rechazado','Despacho');
	
	$estado = get_post_meta($post->ID, '_estado', true);
	$index = 0;
	echo '<select size="1" name="_estado" id="t3">';
	 foreach($posibles_estados as $opt)
	 {
		$selected = ($opt === $estado) ? ' selected="selected"' : '';
		echo '<option value="'.$opt.'" name="'.$opt.'" '.$selected.'>'.$posibles_labels[$index].'</option>';
		$index++;
		}
echo '</select>';

}


function wpt_file() {
	global $post;
	
	$file = get_post_meta($post->ID, '_file', true);
	
	echo ' <input type="text" name="_file" id="_file" value="'.$file.'" />';
	echo ' <input type="button" id="meta-image-button" class="button" value="Seleccionar archivo" />';

};

function wpt_resumen() {
	global $post;
	
	$resumen = get_post_meta($post->ID, '_resumen', true);
	echo '<textarea rows="1" cols="40" name="_resumen" id="_resumen" style="width:100%">'.$resumen.'</textarea>';

};




function add_proyectos_metaboxes() {
	add_meta_box('wpt_proyecto_date', 'Fecha de Proyecto', 'wpt_proyecto_date', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_titulo_proyecto', 'Titulo', 'wpt_titulo_proyecto', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_autor', 'Autor', 'wpt_autor', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_estado', 'Estado', 'wpt_estado', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_file', 'Archivo', 'wpt_file', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_resumen', 'Resumen', 'wpt_resumen', 'proyectos', 'normal', 'high');
}

function wpt_nombre() {
	global $post;
	
	echo '<input type="hidden" name="eventmeta_noncename_persona" id="eventmeta_noncename_persona" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$nombre = get_post_meta($post->ID, '_nombre', true);
	
	echo '<input type="text" name="_nombre" value="' . $nombre  . '" class="widefat" />';

}

function wpt_foto() {
	global $post;
	
	$file = get_post_meta($post->ID, '_imagen', true);
	
	echo ' <input type="text" name="_imagen" id="_imagen" value="'.$file.'" />';
	echo ' <input type="button" id="meta-image-button_persona" class="button" value="Seleccionar Imagen" />';

};


function wpt_mail() {
	global $post;
	$mail = get_post_meta($post->ID, '_mail', true);
	echo '<input type="text" name="_mail" value="' . $mail  . '" class="widefat" />';
}

function wpt_bio() {
	global $post;
	$bio = get_post_meta($post->ID, '_bio', true);
	echo '<textarea rows="1" cols="40" name="_bio" id="_bio" style="width:100%">'.$bio.'</textarea>';

}

function wpt_grupo() {
	global $post;
	$posibles_grupos =  array('_concejales','_secretarios','_politica','_comunicacion');
	$posibles_grupos_labels =  array('Concejales','Gobierno','Políticas públicas ','Comunicación');
	
	$grupo = get_post_meta($post->ID, '_grupo', true);
	$indexpersona = 0;
	echo '<select size="1" name="_grupo" id="t3">';
	 foreach($posibles_grupos as $opt)
	 {
		$selected = ($opt === $grupo) ? ' selected="selected"' : '';
		echo '<option value="'.$opt.'" name="'.$opt.'" '.$selected.'>'.$posibles_grupos_labels[$indexpersona].'</option>';
		$indexpersona++;
		}
echo '</select>';

}

$otherpost;
function wpt_concejal() {
	global $post;
	$preserve_post = $post;
	echo '<input type="hidden" name="eventmeta_noncename_agenda" id="eventmeta_noncename_agenda" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$concejal = get_post_meta($post->ID, '_concejal', true);
	//echo '<input type="text" name="_concejal" value="' . $concejal  . '" class="widefat" />';
	echo '<select size="1" name="_concejal" id="c3">';
	$args = array( 'post_type' => 'personas', 'posts_per_page' => -1, 'meta_query' => array (
				array (
				'key' => '_grupo',
				'value' => '_concejales',
				)
			 ),'order'=>'ASC');
	$looppersonas = new WP_Query( $args );
	while ( $looppersonas->have_posts()) :
		$looppersonas->the_post(); 
		$nombre = get_the_title(get_the_ID()); 
		$selected = ($nombre === $concejal) ? ' selected="selected"' : '';
		echo '<option value="'.$nombre.'" name="'.$nombre.'" '.$selected.'>'.$nombre.'</option>';
	endwhile;
	$post = $preserve_post;
	setup_postdata( $post );
	echo '</select>';
}


function wpt_a_pedido() {
	global $post;
	$apedido = get_post_meta($post->ID, '_apedido', true);
	echo '<input type="text" name="_apedido" value="' . $apedido  . '" class="widefat" />';
}

function wpt_reunion_con() {
	global $post;
	$reunioncon = get_post_meta($post->ID, '_reunioncon', true);
	echo '<input type="text" name="_reunioncon" value="' . $reunioncon  . '" class="widefat" />';
}

function wpt_tema_con() {
	global $post;
	$reunion = get_post_meta($post->ID, '_tema', true);
	echo '<input type="text" name="_tema" value="' . $reunion  . '" class="widefat" />';
}

function wpt_fecha_agenda() {
	global $post;
	$fechagenda = get_post_meta($post->ID, '_fecha_agenda', true);
	echo '<input type="text" name="_fecha_agenda" id="_fecha_agenda" value="' . $fechagenda  . '" class="widefat" />';
}




function add_personas_metaboxes() {
	add_meta_box('wpt_nombre', 'Nombre y apellido', 'wpt_nombre', 'personas', 'normal', 'high');
	add_meta_box('wpt_foto', 'Foto', 'wpt_foto', 'personas', 'normal', 'high');
	add_meta_box('wpt_mail', 'Correo Electrónico', 'wpt_mail', 'personas', 'normal', 'high');
	add_meta_box('wpt_bio', 'Bio', 'wpt_bio', 'personas', 'normal', 'high');
	add_meta_box('wpt_grupo', 'Grupo', 'wpt_grupo', 'personas', 'normal', 'high');
}


function add_eventos_metaboxes(){
	add_meta_box('wpt_concejal', 'Concejal', 'wpt_concejal', 'agenda', 'normal', 'high');
	add_meta_box('wpt_a_pedido', 'A pedido', 'wpt_a_pedido', 'agenda', 'normal', 'high');
	add_meta_box('wpt_reunion_con', 'Reunion Con', 'wpt_reunion_con', 'agenda', 'normal', 'high');
	add_meta_box('wpt_tema_con', 'Tema', 'wpt_tema_con', 'agenda', 'normal', 'high');
	add_meta_box('wpt_fecha_agenda', 'Fecha', 'wpt_fecha_agenda', 'agenda', 'normal', 'high');
	
}



function wpt_fecha_respuesta() {

	global $post;
	echo '<input type="hidden" name="eventmeta_noncename_respuesta" id="eventmeta_noncename_respuesta" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$fecharespuesta = get_post_meta($post->ID, '_fecha_respuesta', true);
	echo '<input type="text" name="_fecha_respuesta" id="_fecha_respuesta" value="' . $fecharespuesta  . '" class="widefat" />';
}

function wpt_nota() {
	global $post;
	$nota = get_post_meta($post->ID, '_nota', true);
	echo '<input type="text" name="_nota" value="' . $nota  . '" class="widefat" />';
}

function wpt_categoria() {
	global $post;
	$categoria = get_post_meta($post->ID, '_categoria', true);
	echo '<input type="text" name="_categoria" value="' . $categoria  . '" class="widefat" />';
}

function wpt_concepto() {
	global $post;
	$concepto = get_post_meta($post->ID, '_concepto', true);
	echo '<input type="text" name="_concepto" value="' . $concepto  . '" class="widefat" />';
}

function wpt_desarrollo() {
	global $post;
	$desarrollo = get_post_meta($post->ID, '_desarrollo', true);
	 wp_editor( $desarrollo, '_desarrollo', array(
        'wpautop'       => true,
        'media_buttons' => true,
        'textarea_name' => '_desarrollo',
        'textarea_rows' => 10,
        'teeny'         => true
    ) );

}

function add_concejales_metaboxes() {
	add_meta_box('wpt_nombre_concejal', 'Nombre', 'wpt_nombre_concejal', 'concejales', 'normal', 'high');
	add_meta_box('wpt_agrupacion', 'Logo de agrupación', 'wpt_agrupacion', 'concejales', 'normal', 'high');
}

function add_votaciones_metaboxes() {
	add_meta_box('wpt_fecha_votaciones', 'Fecha de la Votación', 'wpt_fecha_votaciones', 'votaciones', 'normal', 'high');
	add_meta_box('wpt_concejales', 'Concejales', 'wpt_concejales', 'votaciones', 'normal', 'high');
	add_meta_box('wpt_video_votaciones', 'Video', 'wpt_video_votaciones', 'votaciones', 'normal', 'high');
}

function wpt_concejales() {
	global $post;
	$preserve_post = $post;
	$concejales_totales = get_post_meta($post->ID, 'concejales_totales', true);
	$totalafavor = get_post_meta($post->ID, 'totalafavor', true);
	$totalencontra = get_post_meta($post->ID, 'totalencontra', true);
	$totalabstencion = get_post_meta($post->ID, 'totalabstencion', true);
	$totalausente = get_post_meta($post->ID, 'totalausente', true);
	echo '<input type="hidden" name="eventmeta_noncename_votaciones" id="eventmeta_noncename_votaciones" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	//$concejal = get_post_meta($post->ID, '_concejal', true);
	//echo '<input type="text" name="_concejal" value="' . $concejal  . '" class="widefat" />';
	//echo '<select size="1" name="_concejal" id="c3">';
	echo '<input type="hidden" name="concejales_totales" id="concejales_totales" value="'.htmlspecialchars($concejales_totales).'">';
	$args = array( 'post_type' => 'concejales', 'posts_per_page' => -1,'order'=>'DESC');
	$loopconcejales = new WP_Query( $args );
	echo '<table class="concejales" id="concejales_votaciones">';
 	echo '<tr>';
    echo '<th>Nombre Concejal</th>';
    echo '<th>A favor</th>';
    echo '<th>En contra</th>';
    echo '<th>Abstención</th>';
    echo '<th>Ausente</th>';
  	echo '</tr>';
  	while ( $loopconcejales->have_posts()) :
		$loopconcejales->the_post(); 
		$nombre = get_post_meta(get_the_ID(), '_nombre_concejal', true); 
		$imagen = get_post_meta(get_the_ID(), '_imagen_agrupacion', true); 
		echo '<tr>';
		echo '<td class="nombre-concejal"><img src="'.$imagen.'"><span>'.$nombre.'</span></td><td><input type="radio" name="'.$nombre.'" value="afavor"></td><td><input type="radio" name="'.$nombre.'" value="encontra"></td><td><input type="radio" name="'.$nombre.'" value="abstencion"></td><td><input type="radio" name="'.$nombre.'" value="ausente"></td>';
		echo '</tr>';
	endwhile;
	$post = $preserve_post;
	setup_postdata( $post );
	echo '</table>';
	echo '<table class="totales"><tr>';
	echo '<td>total a favor: <input type="text" id="totalafavor" name="totalafavor" value="'.$totalafavor.'" ></td>';
	echo '<td>total en contra: <input type="text" id="totalencontra" name="totalencontra" value="'.$totalencontra.'" ></td>';
	echo '<td>total abstencion: <input type="text" id="totalabstencion" name="totalabstencion" value="'.$totalabstencion.'" ></td>';
	echo '<td>total ausente: <input type="text" id="totalausente" name="totalausente" value="'.$totalausente.'" ></td>';
	echo '</tr></table>';
}

function wpt_video_votaciones(){
	global $post;
	$videos_votaciones = get_post_meta($post->ID, 'videos_votaciones', true);
	echo '<label for="videos_votaciones">URL de YouTube: </label>';
	echo '<input type="text" name="videos_votaciones" id="videos_votaciones" value="'.$videos_votaciones.'">';
}


function wpt_fecha_votaciones() {

	global $post;
	$fechavotaciones = get_post_meta($post->ID, '_fecha_votaciones', true);
	echo '<input type="text" name="_fecha_votaciones" id="_fecha_votaciones" value="' . $fechavotaciones  . '" class="widefat" />';
}

function wpt_nombre_concejal() {
	global $post;
	
	echo '<input type="hidden" name="eventmeta_noncename_concejal" id="eventmeta_noncename_concejal" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	$nombre_concejal = get_post_meta($post->ID, '_nombre_concejal', true);
	
	echo '<input type="text" name="_nombre_concejal" value="' . $nombre_concejal  . '" class="widefat" />';

}

function wpt_agrupacion() {
	global $post;
	
	$imagen_agrupacion = get_post_meta($post->ID, '_imagen_agrupacion', true);
	
	if($imagen_agrupacion){
		echo '<img src="'.$imagen_agrupacion.'"/><br>';
		
	}
	
	echo ' <input type="text" name="_imagen_agrupacion" id="_imagen_agrupacion" value="'.$imagen_agrupacion.'" />';
	echo ' <input type="button" id="meta-image-button_concejal" class="button" value="Seleccionar Imagen" />';

};


function add_respuestas_metaboxes(){
	add_meta_box('wpt_fecha_respuesta', 'Fecha', 'wpt_fecha_respuesta', 'respuesta', 'normal', 'high');
	add_meta_box('wpt_nota', 'Nota', 'wpt_nota', 'respuesta', 'normal', 'high');
	add_meta_box('wpt_concepto', 'Concepto', 'wpt_concepto', 'respuesta', 'normal', 'high');
	add_meta_box('wpt_categoria', 'Categoría', 'wpt_categoria', 'respuesta', 'normal', 'high');
	add_meta_box('wpt_desarrollo', 'Desarrollo', 'wpt_desarrollo', 'respuesta', 'normal', 'high');
	
}



/*custom fields*/

add_action( 'add_meta_boxes', 'add_subsidios_metaboxes' );
add_action( 'add_meta_boxes', 'add_proyectos_metaboxes' );
add_action( 'add_meta_boxes', 'add_personas_metaboxes' );
add_action( 'add_meta_boxes', 'add_eventos_metaboxes' );
add_action( 'add_meta_boxes', 'add_respuestas_metaboxes' );



function my_enqueue($hook) {
		if ( 'edit.php' == $hook ) {
				return;
		}
		wp_enqueue_media();
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('google-map-api','https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyChYCQ7TAvJC6E_I4XCnEuOTDuOV-_lOWY'); 
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
		wp_enqueue_style('admin-style',  get_template_directory_uri() . '/css/admin.css');

		wp_enqueue_script( 'my_custom_script', get_template_directory_uri() . '/js/admin.js' );
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );


// Save the Metabox Data

function wpt_save_events_meta($post_id, $post) {
	
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
	
	$events_meta['_institucion'] = $_POST['_institucion'];
	$events_meta['_sesion'] = $_POST['_sesion'];
	$events_meta['_territorio'] = $_POST['_territorio'];
	$events_meta['_objetivo'] = $_POST['_objetivo'];
	$events_meta['_monto'] = $_POST['_monto'];
	
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


function wpt_save_proyectos_meta($post_id, $post) {
	
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
	$proyectos_meta['_resumen'] = $_POST['_resumen'];
	
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

function wpt_save_agenda_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename_agenda'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$agenda_meta['_concejal'] = $_POST['_concejal'];
	$agenda_meta['_apedido'] = $_POST['_apedido'];
	$agenda_meta['_reunioncon'] = $_POST['_reunioncon'];
	$agenda_meta['_tema'] = $_POST['_tema'];
	$agenda_meta['_fecha_agenda'] = $_POST['_fecha_agenda'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($agenda_meta as $key => $value) { // Cycle through the $events_meta array!
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


function wpt_save_respuesta_meta($post_id, $post) {

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename_respuesta'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$respuesta_meta['_fecha_respuesta'] = $_POST['_fecha_respuesta'];
	$respuesta_meta['_nota'] = $_POST['_nota'];
	$respuesta_meta['_categoria'] = $_POST['_categoria'];
	$respuesta_meta['_desarrollo'] = $_POST['_desarrollo'];
	$respuesta_meta['_concepto'] = $_POST['_concepto'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($respuesta_meta as $key => $value) { // Cycle through the $events_meta array!
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


function wpt_save_personas_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename_persona'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$personas_meta['_nombre'] = $_POST['_nombre'];
	$personas_meta['_imagen'] = $_POST['_imagen'];
	$personas_meta['_mail'] = $_POST['_mail'];
	$personas_meta['_bio'] = $_POST['_bio'];
	$personas_meta['_grupo'] = $_POST['_grupo'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($personas_meta as $key => $value) { // Cycle through the $events_meta array!
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


function wpt_save_concejales_meta($post_id, $post) {
	
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename_concejal'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	
	$concejales_meta['_nombre_concejal'] = $_POST['_nombre_concejal'];
	$concejales_meta['_imagen_agrupacion'] = $_POST['_imagen_agrupacion'];
	
	foreach ($concejales_meta as $key => $value) { // Cycle through the $events_meta array!
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


function wpt_save_votaciones_meta($post_id, $post) {
	
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename_votaciones'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	
	$votaciones_meta['concejales_totales'] = $_POST['concejales_totales'];
	$votaciones_meta['videos_votaciones'] = $_POST['videos_votaciones'];
	$votaciones_meta['totalafavor'] = $_POST['totalafavor'];
	$votaciones_meta['totalencontra'] = $_POST['totalencontra'];
	$votaciones_meta['totalabstencion'] = $_POST['totalabstencion'];
	$votaciones_meta['totalausente'] = $_POST['totalausente'];
	$votaciones_meta['_fecha_votaciones'] = $_POST['_fecha_votaciones'];
	
	foreach ($votaciones_meta as $key => $value) { // Cycle through the $events_meta array!
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


function wpt_save_barrios_meta($post_id, $post) {
	
	

	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	
	$barrios_meta['_pins_en_proyecto'] = $_POST['_pins_en_proyecto'];
	
	foreach ($barrios_meta as $key => $value) { // Cycle through the $events_meta array!
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



add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_proyectos_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_personas_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_agenda_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_respuesta_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_concejales_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_votaciones_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_barrios_meta', 1, 2); // save the custom fieldsx<





$new_general_setting = new new_general_setting();

class new_general_setting {
		function new_general_setting( ) {
				add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
		}
		function register_fields() {
				register_setting( 'general', 'desc_general', 'esc_attr' );
				add_settings_field('fav_color', '<label for="desc_general">Descripcion general del sitio</label>' , array(&$this, 'fields_html') , 'general' );
		}
		function fields_html() {
				$value = get_option( 'desc_general', '' );
				echo '<textarea id="desc_general" name="desc_general">' . $value . '</textarea>';
		}
}

require_once('wp_bootstrap_navwalker.php');
add_theme_support( 'menus' );


function wpb_adding_scripts() {
wp_enqueue_script('google-map-api','https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyChYCQ7TAvJC6E_I4XCnEuOTDuOV-_lOWY',array('jquery')); 
wp_register_script('my_amazing_script', get_template_directory_uri() . '/js/transparencia.js' , array('jquery'),'1.1', true);
wp_enqueue_script('my_amazing_script');

}



add_action( 'wp_enqueue_scripts', 'wpb_adding_scripts' );  


function shortcode_votaciones($atts) {
	global $post;
		extract(shortcode_atts(array(
			'afavor'        => 0,
			'encontra'      => 0,
			'abstenciones'  => 0,
			'ausentes'  => 0,
	 ), $atts));
	require_once('votaciones.php');

	return votaciones($post->ID,$afavor,$encontra,$abstenciones,$ausentes);
}
add_shortcode('votaciones', 'shortcode_votaciones');


function shortcode_video($atts){

	 extract(shortcode_atts(array(
			'url'        => 0,
	 ), $atts));
	 $urlpart = explode("v=",$url);
	$code = '<div class="video-wrapper"><div style="position: relative; padding-bottom: 56.25%; height: 0;"><iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="https://www.youtube.com/embed/'.$urlpart[1].'" width="100%" height="150" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div></div>';
	return $code;
}

add_shortcode('video', 'shortcode_video');

function fb_opengraph() {
		global $post;
		?>  
		<meta property="og:title" content="Cuentas Claras"/>
		<meta property="og:description" content="<?php echo $excerpt; ?>"/>
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="<?php echo get_permalink(); ?>"/>
		<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
		<meta property="og:image" content="<?php echo  get_stylesheet_directory_uri() . '/img/banner_web_portal_transp.png'; ?>"/>

<?php
}
add_action('wp_head', 'fb_opengraph', 5);


function shortcode_img($atts){

	 extract(shortcode_atts(array(
			'url'        => 0,
	 ), $atts));
	$code = '<div class="abrir-modal"><span class="glyphicon glyphicon-plus"></span> ver detalle de la votación</div>';
	$code .= '<div class="modal"><img src="'.$url.'"/></div>';
	return $code;
}

add_shortcode('modal-votaciones', 'shortcode_img');


/*Creacion de la admin page */

add_action( 'admin_menu', 'wpse_91693_register' );

function wpse_91693_register()
{
    add_menu_page(
        'Contactos del formulario',     // page title
        'Aportes de la gente',     // menu title
        'editor',   // capability
        'include-text',     // menu slug
        'wpse_91693_render' // callback function
    );
}
function wpse_91693_render()
{
    global $title;
    global $wpdb;

    //$file = plugin_dir_path( __FILE__ ) . "included.html";

    include( get_template_directory() . '/includes/aportes.php');

    //if ( file_exists( $file ) )
     //   require $file;

}
