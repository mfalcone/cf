<?

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
			'supports' => array( 'title', 'thumbnail','editor'),
			'capability_type' => 'post',
			'rewrite' => array("slug" => "eventos"), // Permalinks format
			'menu_position' => 7,
			'register_meta_box_cb' => 'add_eventos_metaboxes'
		)
	);


function fechaInicio() {
	global $post;
	$fecha_inicio = get_post_meta($post->ID, 'fecha_inicio', true);
	echo $fecha_inicio;
	echo '<input type="date" name="fecha_inicio" id="fecha_inicio" value="' . $fecha_inicio  . '" class="widefat" />';
}

function horaInicio() {
	global $post;
	$hora_inicio = get_post_meta($post->ID, 'horario_inicio', true);
	echo $hora_inicio;
	echo '<input type="time" name="horario_inicio" id="horario_inicio" value="' . $hora_inicio  . '" class="widefat" />';
}

function fechaFin() {
	global $post;
	$fecha_fin = get_post_meta($post->ID, 'fecha_fin', true);
	echo $fecha_fin;
	echo '<input type="date" name="fecha_fin" id="fecha_fin" value="' . $fecha_fin  . '" class="widefat" />';
}

function horaFin() {
	global $post;
	$hora_fin = get_post_meta($post->ID, 'hora_fin', true);
	echo $horario_fin;
	echo '<input type="time" name="hora_fin" id="horario_fin" value="' . $hora_fin  . '" class="widefat" />';
}

function userLevel() {
	global $post;
	$posibles_estados =  array('_ingresante','_organico');
	$posibles_labels =  array('Ingresante','Organico');
	
	$estado = get_post_meta($post->ID, 'nivel-usuario', true);
	$index = 0;
	echo '<select size="1" name="nivel-usuario" id="t3">';
	 foreach($posibles_estados as $opt)
	 {
		$selected = ($opt === $estado) ? ' selected="selected"' : '';
		echo '<option value="'.$opt.'" name="'.$opt.'" '.$selected.'>'.$posibles_labels[$index].'</option>';
		$index++;
		}
echo '</select>';
}


function add_eventos_metaboxes(){
	add_meta_box('fechaInicio', 'Fecha de Incio', 'fechaInicio', 'agenda', 'normal', 'high');
	add_meta_box('horaInicio', 'Horario de Inicio', 'horaInicio', 'agenda', 'normal', 'high');
	add_meta_box('fechaFin', 'Fecha de Fin', 'fechaFin', 'agenda', 'normal', 'high');
	add_meta_box('horaFin', 'Horario de Fin', 'horaFin', 'agenda', 'normal', 'high');
	add_meta_box('userLevel', 'Nivel de usuario', 'userLevel', 'agenda', 'normal', 'high');

}


function wpt_save_agenda_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	/*if ( !wp_verify_nonce( $_POST['eventmeta_noncename_agenda'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}*/

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	/*$agenda_meta['_concejal'] = $_POST['_concejal'];
	$agenda_meta['_apedido'] = $_POST['_apedido'];
	$agenda_meta['_reunioncon'] = $_POST['_reunioncon'];
	$agenda_meta['_tema'] = $_POST['_tema'];
	*/
	$agenda_meta['fecha_inicio'] = $_POST['fecha_inicio'];
	$agenda_meta['fecha_fin'] = $_POST['fecha_fin'];
	$agenda_meta['horario_inicio'] = $_POST['horario_inicio'];
	$agenda_meta['hora_fin'] = $_POST['hora_fin'];
	$agenda_meta['nivel-usuario'] = $_POST['nivel-usuario'];
	
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

add_action('save_post', 'wpt_save_agenda_meta', 1, 2); // save the custom fieldsx<

