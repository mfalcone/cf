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
	<span class="hash">#</span><h2>la agenda</h2>
	<ul class="agenda">	
		<?php 
			echo $today;
			$args = array('post_type' => 'agenda',
							'posts_per_page' => 2, 
							'meta_query' => array(
							    array(
							        'key'		=> 'fecha_inicio',
							        'compare'	=> '>=',
							        'value'		=> date("Y-m-d"),
							        'type' => 'NUMERIC,'
							    )
						    ),
							'meta_key'=>'fecha_inicio', 
							'orderby' => 'meta_value', 
							'order' => 'DESC'  );
		$loop = new WP_Query( $args );
		//print_r($loop);
		while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<li>
		<?php the_title(); ?>
		<?php 
		$fecha_inicio = get_post_meta(get_the_ID(), 'fecha_inicio', true); 
		echo $fecha_inicio;?>
		</li>
	</ul>
	<?php endwhile; ?>

	</aside>
	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			footer
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php } ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
