<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package victoriacolectiva
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('medium');
			}
			get_template_part( 'template-parts/content', get_post_format() );?>
			<?php comments_template(); ?>
		<?php endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
