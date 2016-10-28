<?php /* Template Name:Aportes */ 

	global $wpdb;
    // creates ayuda_table in database if not exists
    $table = "aportes_hagamos"; 
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS $table (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `nombre` text  NULL,
        `cbu` text  NULL,
        `tipodecuenta` text  NULL,
        `cuenta` text  NULL,
        `dinero` text  NULL,
        `numerocuenta` text  NULL,
       
    UNIQUE (`id`)
    ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    $telefono = bp_get_profile_field_data('field=Numero de Celular&user_id=' . bp_loggedin_user_id() );
    $current_user = wp_get_current_user();
    $username = $current_user->user_login;

	$table_llamar = "llamar_por_aportes"; 
    $charset_collate_llamar = $wpdb->get_charset_collate();
    $sql_llamar = "CREATE TABLE IF NOT EXISTS $table_llamar (
        `id` mediumint(9) NOT NULL AUTO_INCREMENT,
        `nombre` text  NULL,
        `telefono` text  NULL,
       
    UNIQUE (`id`)
    ) $charset_collate_llamar;";
    dbDelta( $sql_llamar );




get_header(); // This fxn gets the header.php file and renders it ?>

			
			<?php 
			if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>
	
				<div class="row">
						<div class="col-md-12 main-texto">
								<h1>
									<?php the_title(); ?>
								</h1>
								<div class="image">
									<?php the_post_thumbnail( 'large' );  ?>
								</div>
								<?php the_content(); ?>
						</div>
				</div>
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
		
			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">No hay nada</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
<div class="row" id="contact_form" data-form="<?php bloginfo('template_directory');?>">
	<p>Dejá tus datos con confianza, este sitio es seguro. Sólo nosotros tendremos acceso a tus datos,que serán
remitidios directamente al banco para la efectivización del débito directo.</p>
	<fieldset>
		<label for="elegi">AUTORIZO EL DEBITO MENSUAL DE:</label>
		<ul class="dinero">
		<!--glyphicon glyphicon-unchecked  glyphicon glyphicon-check-->
			<li> <span class="glyphicon empty-circle" data-check="100"></span> <strong>$100</strong> ($3,30 por día)</li>
			<li> <span class="glyphicon empty-circle" data-check="200"></span> <strong>$200</strong> ($6,60 por día)</li>
			<li> <span class="glyphicon empty-circle" data-check="500"></span> <strong>$500</strong> ($16,60 por día)</li>
			<li id="otro"> <span class="glyphicon empty-circle" data-check="otro"></span> otro <input type="text" id="otro_input"></li>
		</ul>
	</fieldset>
	<fieldset>
		<label for="nombre">Nombre y Apellido</label>
		<input type="text" placeholder="Nombre" id="nombre" name="nombre">
		<label for="cbu">CBU</label>
		<input type="text" placeholder="CBU" id="cbu" name="cbu">
		<label for="tipo_1">Tipo de cuenta</label>
		<ul class="tipocuenta">
			<li><span class="glyphicon empty-circle" data-check="cuenta corriente"></span>Cuenta Corriente</li>
			<li><span class="glyphicon empty-circle" data-check="caja de ahorro"></span>Caja de Ahorro</li>
		</ul>
		<label for="tipo_2">Tipo de cuenta</label>
		<ul class="cuenta">
			<li><span class="glyphicon empty-circle" data-check="cuit"></span>CUIT</li>
			<li><span class="glyphicon empty-circle" data-check="cuil"></span>CUIL</li>
			<li><span class="glyphicon empty-circle" data-check="cdi"></span>CDI</li>
		</ul>
		<input type="text" placeholder="Número" id="numero" name="numero">
	</fieldset>
	<div class="enviar-wrapper">
		<div class="enviar" id="enviar">Donar</div>
	</div>
</div>
<div class="row llamada">
	<h3 class="col-md-5" id="prefiero_que_me_llamen"><span class="glyphicon glyphicon-earphone"></span> Prefiero que me llamen</h3>
	<p class="col-md-7">Si preferís asociarte al débito directo por teléfono, dale click al botón “Prefiero que me llamen” y nos ponemos en contacto.</p>
</div>
<script type="text/javascript">
	var username = "<?php echo $username; ?>";
	var telefono = "<?php echo $telefono; ?>";
</script>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>