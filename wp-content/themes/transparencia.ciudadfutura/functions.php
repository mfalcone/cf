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




function add_proyectos_metaboxes() {
	add_meta_box('wpt_proyecto_date', 'Fecha de Proyecto', 'wpt_proyecto_date', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_titulo_proyecto', 'Titulo', 'wpt_titulo_proyecto', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_autor', 'Autor', 'wpt_autor', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_estado', 'Estado', 'wpt_estado', 'proyectos', 'normal', 'high');
	add_meta_box('wpt_file', 'Archivo', 'wpt_file', 'proyectos', 'normal', 'high');
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



/*custom fields*/

add_action( 'add_meta_boxes', 'add_subsidios_metaboxes' );
add_action( 'add_meta_boxes', 'add_proyectos_metaboxes' );
add_action( 'add_meta_boxes', 'add_personas_metaboxes' );
add_action( 'add_meta_boxes', 'add_eventos_metaboxes' );



function my_enqueue($hook) {
		if ( 'edit.php' == $hook ) {
				return;
		}
		wp_enqueue_media();
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

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


add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_proyectos_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_personas_meta', 1, 2); // save the custom fieldsx<
add_action('save_post', 'wpt_save_agenda_meta', 1, 2); // save the custom fieldsx<





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
	 ), $atts));
	require_once('votaciones.php');

	return votaciones($post->ID,$afavor,$encontra,$abstenciones);
}
add_shortcode('votaciones', 'shortcode_votaciones');


function shortcode_video($atts){

	 extract(shortcode_atts(array(
			'url'        => 0,
	 ), $atts));
	 $urlpart = explode("v=",$url);
	$code = '<div style="position: relative; padding-bottom: 56.25%; height: 0;"><iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="https://www.youtube.com/embed/'.$urlpart[1].'" width="100%" height="150" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
	return $code;
}

add_shortcode('video', 'shortcode_video');

function fb_opengraph() {
		global $post;
		?>  
		<meta property="og:title" content="<?php echo the_title(); ?>"/>
		<meta property="og:description" content="<?php echo $excerpt; ?>"/>
		<meta property="og:type" content="article"/>
		<meta property="og:url" content="<?php echo the_permalink(); ?>"/>
		<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
		<meta property="og:image" content="<?php echo  get_stylesheet_directory_uri() . '/img/banner_web_portal_transp.png'; ?>"/>

<?php
}
add_action('wp_head', 'fb_opengraph', 5);
