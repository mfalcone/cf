<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package victoriacolectiva
 */

?>
	</div><!-- #content -->

	<?php if(!is_front_page() && !is_page('registrar') &&!is_page('reset')){?> 
	<aside id="right-sidebar" class="open">
		<div class="pestania"><span class="glyphicon glyphicon-list"></span></div>
		<?php if(is_user_logged_in()){?>
		<div id="right-sidebar-wrapper">
			<span class="hash agenda">#</span><h2 class="agenda">Agenda</h2>
			<ul class="agenda">	
				<?php
					if ( current_user_can('organico') ){
						$args = array('post_type' => 'agenda',
									'posts_per_page' => 2, 
									'meta_query' => array(
									    array(
									        'key'		=> 'fecha_inicio',
									        'compare'	=> '>=',
									        'value'		=> date("Y-m-d"),
									        'type' => 'NUMERIC,'
									    ),
								    ),
									'meta_key'=>'fecha_inicio', 
									'orderby' => 'meta_value', 
									'order' => 'ASC'  );
					}else{

					$args = array('post_type' => 'agenda',
									'posts_per_page' => 2, 
									'meta_query' => array(
									    array(
									        'key'		=> 'fecha_inicio',
									        'compare'	=> '>=',
									        'value'		=> date("Y-m-d"),
									        'type' => 'NUMERIC,'
									    ),
									    array(
									        'key'		=> 'nivel-usuario',
									        'compare'	=> '==',
									        'value'		=> '_ingresante',
									    )
								    ),
									'meta_key'=>'fecha_inicio', 
									'orderby' => 'meta_value', 
									'order' => 'ASC'  );
				}

				$loop = new WP_Query( $args );
				//print_r($loop);
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
					<li>
					
					<?php 
					$fecha_inicio = get_post_meta(get_the_ID(), 'fecha_inicio', true); 
					$hora_inicio = get_post_meta(get_the_ID(), 'horario_inicio', true); 
					$fecha_fin = get_post_meta(get_the_ID(), 'fecha_fin', true); 
					$horario_fin = get_post_meta(get_the_ID(), 'hora_fin', true);
					?> 

					<div class="date">
					inicio: <?php echo date("d/m", strtotime($fecha_inicio));?> - <?php echo $hora_inicio;?>hs. | 
					fin:<?php echo date("d/m", strtotime($fecha_fin));?> - <?php echo $horario_fin;?>hs.</div>
					<h3><?php the_title(); ?></h3>
					<div class="content no">
						<?php 
							$my_content=apply_filters('the_content',$post->post_content);//this will get the content for you
							$trimmed_my_content = wp_trim_words( $my_content, 10, '<a href="'. get_home_url() .'/agenda">&nbsp;<span class="moretext">Leer mas</span></a>' );
		    				echo $trimmed_my_content;
						?>
					</div>
					</li>
				<?php endwhile; ?>
				<li class="agenda-controles">
					<a href="<?php echo get_home_url(); ?>/agenda"><span class="glyphicon glyphicon-calendar"></span>Ver toda la agenda</a><br>
					<a href="<?php echo get_home_url(); ?>/agregar-evento"><span class="glyphicon glyphicon-plus"></span>Agregar Evento</a>
				</li>
			</ul>
			<div class="widget">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Barra derecha") ) : ?>
				<?php endif;?>
			</div>
		</div>
		<?php }else{ ?>
			<h3><span class="glyphicon glyphicon-comment"></span>¿Qué es Hagamos?</h3>
			<p>
				Hagamos Ciudad Futura es una red social para la participación ciudadana creada en Rosario por Ciudad Futura. El objetivo es que quien quiera brindar su aporte para la construcción de una sociedad más justa tenga un ámbito ideado acordemente para poder volcar sus ideas, proyectos y experiencias. La plataforma es de libre ingreso. Sólo necesitas estar registrado.
			</p>
			<hr>
			<p>
				Si ya tenés cuenta, podés ingresar desde acá con tu correo electrónico y tu contraseña.
			</p>
			<form id="pippin_login_form" class="pippin_form"action="" method="post">
				<fieldset>
					<p>
						<span class="glyphicon glyphicon-envelope" title="Correo Electrónico"></span>
						<input name="pippin_user_login" id="pippin_user_login" class="required" type="text"/>
					</p>
					<p>
						<span class="glyphicon glyphicon-asterisk" title="Contraseña"></span>
						<input name="pippin_user_pass" id="pippin_user_pass" class="required" type="password"/>
					</p>
					<footer>
						<input type="hidden" name="pippin_login_nonce" value="<?php echo wp_create_nonce('pippin-login-nonce'); ?>"/>
						<input id="login-submit" type="submit" value="ingresar"/>
					</footer>
				</fieldset>
			</form>
	<?php }?>
	</aside>
	<footer id="colophon" class="site-footer open" role="contentinfo">
		<div class="site-info">
		<?php 
		function bpfr_pm_to_author() {	
			$author = get_the_author();
			echo '<a href="'.wp_nonce_url( bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?r=hagamosciudadfutura' ) .' title="mensaje privado">Mensaje Privado</a>';
			} 
		$user_id = get_current_user_id();?>
			<p>Por dudas o consultas sobre el funcionamiento de la red comunicate por correo electrónico a <a href="mailto:hagamos@ciudadfutura.com.ar">hagamos@ciudadfutura.com.ar</a></p>
			<p>o por <?php bpfr_pm_to_author()?></p>
			<div class="footer-logo"></div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php } ?>
</div><!-- #page -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-86899402-1', 'auto');
  ga('send', 'pageview');

</script>
<?php wp_footer(); ?>

</body>
</html>
