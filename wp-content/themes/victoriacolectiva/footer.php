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

	<?php if(is_user_logged_in()){?>
	<aside id="right-sidebar" class="open">
	<div class="pestania"><span class="glyphicon glyphicon-list"></span></div>
	<span class="hash agenda">#</span><h2 class="agenda">Agenda</h2>
	<ul class="agenda">	
		<?php 
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
	</aside>
	<footer id="colophon" class="site-footer open" role="contentinfo">
		<div class="site-info">
			<div class="footer-logo"></div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php } ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
