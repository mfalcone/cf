<?php 
/**
 * 	Template Name: Sidebar/Home Page
 *
 *	modelo de template para página custom
 *
*/
get_header(); ?>
	<div id="primary" class="row-fluid">
			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

							<?php the_content(); ?>
					
				<?php endwhile;?>

			<?php else :?>
				404
			<?php endif;?>
		<div id="sidebar" role="sidebar">
			<?php get_sidebar(); ?>
		</div>
<?php get_footer(); ?>