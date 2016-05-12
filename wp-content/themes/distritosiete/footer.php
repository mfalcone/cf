<?php
	/*-----------------------------------------------------------------------------------*/
	/* This template will be called by all other template files to finish 
	/* rendering the page and display the footer area/content
	/*-----------------------------------------------------------------------------------*/
?>


<?php wp_footer(); 
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>
<footer>
	<section>
		<div class="blog">
			<?php $my_query = new WP_Query('category_name=actualizaciones&showposts=1'); ?>
			<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<a href="<?php the_permalink() ?>"></a>
			<h3>[BLOG] ULTIMA ENTRADA</h3>
			<p><?php the_title(); ?></p>
			<?php endwhile; ?>
		</div>
		<div class="logo">
			<img src="<?php bloginfo('template_directory');?>/img/iso_footer.png" alt="logo">
			<a href="<?php echo get_site_url(); ?>">www.ciudadfutura.com.ar</a>
		</div>
		<div class="videoblog">
			<?php $my_query = new WP_Query('category_name=video&showposts=1'); ?>
			<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<a href="<?php the_permalink() ?>"></a>
			<h3>[VIDEOBLOG] ULTIMA ENTRADA</h3>
			<p><?php the_title(); ?></p>
			<?php endwhile; ?>
		</div>
	</section>
</footer>
   </body>
   </html>