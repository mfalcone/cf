<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>

<section class="container single">
			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post();
					$thumbID = get_post_thumbnail_id( $post->ID );
					$imgDestacada = wp_get_attachment_url( $thumbID );
				 ?>
				
				<div class="col-md-12">			
					<div class="image-wrapper"><img src="<?php echo $imgDestacada; ?>" alt=""></div>
					<h1><?php the_title();?></h1>
					<div class="expert">
						<?php the_excerpt(); ?>
					</div>
					<div class="content">
						<?php the_content();?>
					</div>
				</div>

				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
	

			<?php endif; ?>
</section>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>