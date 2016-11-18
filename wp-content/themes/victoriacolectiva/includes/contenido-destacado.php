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

function justificacion(){
	global $post;
	$justificacion = get_post_meta($post->ID, '_justificacion', true);
	echo '<input type="text" name="_justificacion" id="_justificacion" value="' . $justificacion  . '" />';	
}

function img(){
	global $post;
	$img = get_post_meta($post->ID, '_img', true);
	echo '<img src="'.$img.'"/>';
	echo '<input type="text" name="_img" id="_img" value="' . $img  . '" />';	
}

function add_destacados_metaboxes(){
	add_meta_box('autor', 'Autor', 'autor', 'contenido-destacado', 'normal', 'high');
	add_meta_box('vinculo', 'Link', 'vinculo', 'contenido-destacado', 'normal', 'high');
	add_meta_box('justificacion', 'Justificación', 'justificacion', 'contenido-destacado', 'normal', 'high');
	add_meta_box('img', 'Avatar', 'img', 'contenido-destacado', 'normal', 'high');
}


function apf_addpost() {
    $results = '';
 
    $title = $_POST['apftitle'];
    $content =  $_POST['apfcontents'];
    $autor = $_POST['autor'];
    $vinculo = $_POST['vinculo'];
    $user_id = $_POST['user_id'];
    $justificacion = $_POST['justificacion'];
    $img = $_POST['img'];
 	$user_info = get_userdata($user_id);
 	$mail = $user_info->user_email;
 	$name = sanitize_title($title);
 	
    $post_id = wp_insert_post( array(
        'post_title'        => $title,
        'post_name'        => $name,
        'post_content'      => $content,
        'post_status'       => 'publish',
        'post_author'       => $user_id ,
        'post_type' 		=> 'contenido-destacado'
    ) );
 	
 	update_post_meta($post_id,'_autor',$autor);
	update_post_meta($post_id,'_vinculo',$vinculo);
	update_post_meta($post_id,'_justificacion',$justificacion);
	update_post_meta($post_id,'_img',$img);
	$permalink = get_permalink( $post_id );
    
    if ( $post_id != 0 )
    {	
    	$subject = 'Felicitaciones, tu aporte en hagamos.ciudadfutura.com.ar ha sido calificado como contenido destacado';
		$message = 'Te informamos que tu mensaje en la Red Social Hagamos Ciudad Futura ha sido definido como <b>Mensaje Destacado.</b>';
		$message .= '<br><b>Razón:</b> <br>';
		$message .= '<i>'.$justificacion.'</i>';
		$message .= '<br><br>Para verlo ingresá a <a href="http://hagamos.ciudadfutura.com.ar">http://hagamos.ciudadfutura.com.ar</a><br>compartí el enlace público en tus redes sociales: <div dir="ltr"><a href="'.$permalink.'">'.$permalink.'</a></div>Muchas gracias por tu aporte a la participación ciudadana. Y sigamos construyendo hoy y entre todos la sociedad que queremos para mañana.';

    	$data = array(
		    'mail'      => $mail,
		    'subject'    => $subject,
		    'msj'       => $message
		);
        $results = json_encode($data);
        /*envio de mail*/
    	
		
    }
    else {
        $results = '*Ha ocurrido un error';
    }
    // Return the String
    die($results);
}

// creating Ajax call for WordPress
//add_action( 'wp_ajax_nopriv_apf_addpost', 'apf_addpost' );
add_action( 'wp_ajax_apf_addpost', 'apf_addpost' );

function wpse27856_set_content_type(){
    return "text/html";
}

function mycustomtheme_send_mail_before_submit(){
    if ( isset($_POST['action']) && $_POST['action'] == "mail_before_submit" ){
    	$toemail = $_POST['toemail'];
    	$subject = $_POST['subject'];
    	$msj = $_POST['msj'];
    	$headers = array('Content-Type: text/html; charset=UTF-8');
    //send email  wp_mail( $to, $subject, $message, $headers, $attachments ); ex:
		add_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
        wp_mail($toemail,$subject,stripslashes($msj));
        remove_filter( 'wp_mail_content_type','wpse27856_set_content_type' );
        echo 'Correo enviado';
        die();
    }
    echo 'error';
    die();
}

add_action('wp_ajax_mail_before_submit', 'mycustomtheme_send_mail_before_submit');

function apf_enqueuescripts()
{
	if ( current_user_can('administrator') ){
		wp_enqueue_script( 'admin',  get_template_directory_uri() . '/js/gestion.js',array('jquery'),'1.0' );
    	wp_localize_script( 'admin', 'apfajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    	wp_enqueue_style( 'gestionstyle',get_template_directory_uri() . '/_inc/css/gestion.css',false,'1.1','all' );   
	}
}
add_action('wp_enqueue_scripts', 'apf_enqueuescripts');


add_action( 'widgets_init', 'destacados_widget_init' );
 
function destacados_widget_init() {
    register_widget( 'contenidos_destacados_widget' );
}
 
class contenidos_destacados_widget extends WP_Widget
{
 
    public function __construct()
    {
        $widget_details = array(
            'classname' => 'contenidos_destacados_widget',
            'description' => 'Slider de Contenido Destacados'
        );
 
        parent::__construct( 'contenidos_destacados_widget', 'Contenidos destacados', $widget_details );
 
    }
 
    public function form( $instance ) {
        // Backend Form
    }
 
    public function update( $new_instance, $old_instance ) {  
        return $new_instance;
    }
 
    public function widget( $args, $instance ) {?>
        	<div class="contenidos-destacados container">
				<div class="col-md-1 col-md-offset-1 titulo icono col-sm-1 col-xs-1"><span class="glyphicon glyphicon-star"></span></div>
				<div class="col-md-6 titulo col-sm-9 col-xs-9">Contenidos destacados:</div>
				<div class="col-md-4 col-xs-2 titulo" id="dot-container"></div>
				<ul class="col-md-11 col-md-offset-1 col-sm-12 col-xs-12">
						<?php 
						$args = array('post_type' => 'contenido-destacado','posts_per_page' => 5);
						$loop = new WP_Query( $args );
						//print_r($loop);
						$cont = 0;
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<?php 
							$autor = get_post_meta(get_the_ID(), '_autor', true); 
							$vinculo = get_post_meta(get_the_ID(), '_vinculo', true); 
							$img = get_post_meta(get_the_ID(), '_img', true);
							
							?>
							<li class="row" id="elem-<?php echo $cont;?>">
								
								<div class="col-md-1 col-sm-1 col-xs-1 avatar-texto">
									<img src="<?php echo $img; ?>" />
									<p>por: <?php echo $autor; ?></p>
								</div>
								<div class="col-md-10 col-sm-9 col-xs-9">
									<h3><?php the_title();?></h3>
									<p><?php echo wp_trim_words( get_the_content(), 40 ); ?></p>
								</div>
								<div class="col-md-1 bt col-sm-1 col-xs-1">
									<a href="<?php echo $vinculo; ?>">participar</a>
								</div>
								
							</li>
						<?php $cont++;?>

						<?php endwhile; ?>
				</ul>
			</div>
              <script type="text/javascript">
                
                    $(".contenidos-destacados li").each(function(ind,elem){
                    	$("#dot-container").append('<a href="#" class="dot" id="dot-'+ind+'"></a>')
                    })

                   function visibilizarItem(ind,del){
                   		$("#dot-container #dot-"+ind).addClass("selected");
                   		$(".contenidos-destacados li:eq("+ind+")").delay(500).fadeIn(del)
                   }

                   var count = 0;
                   visibilizarItem( $(".contenidos-destacados li").length-1,0);
                   var timer = setInterval(function() {
                   	$(".contenidos-destacados li").fadeOut(500);
                   	$("#dot-container .dot").removeClass("selected");
	                   	
					    visibilizarItem(count,500);
					    if(count < $(".contenidos-destacados li").length-1){
						    count++
						}else{
							count = 0;
					    }
					}, 6000);
                   $("#dot-container .dot").click(function(e){
	                   	$("#dot-container .dot").removeClass("selected");
	                   	$(".contenidos-destacados li").hide();
                   		var index = $(e.target).index();
                   		count = index;
                   		visibilizarItem(count,0);
                   		clearTimeout(timer);
                   })

            </script>
    <?php }
 
}

function wpt_save_destacados_meta($post_id, $post) {
	
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	$destacadas_meta['_autor'] = $_POST['_autor'];
	$destacadas_meta['_vinculo'] = $_POST['_vinculo'];
	$destacadas_meta['_justificacion'] = $_POST['_justificacion'];
	$destacadas_meta['_img'] = $_POST['_img'];
	
	foreach ($destacadas_meta as $key => $value) { // Cycle through the $events_meta array!
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


add_action('save_post', 'wpt_save_destacados_meta', 1, 2); // save the custom fieldsx<