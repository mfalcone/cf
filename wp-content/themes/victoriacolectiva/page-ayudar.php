<?php /* Template Name:Quiero Ayudar */ 
get_header(); ?>

			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>
	
				<div class="row">
						<div class="col-md-12">
								<h1>
									<?php the_title(); ?>
								</h1>
								<?php the_content(); ?>
						</div>
				</div>
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
		
			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
<div class="row quiero-ayudar-posts">

	<?php 
	//'meta_key'=>'_proyecto', 'orderby' => 'meta_value',
	$args = array( 'category_name' => 'quiero_ayudar', 'posts_per_page' => -1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<article>
			<h1><?php the_title(); ?></h1>
			<div class="contenido">
				<div class="imagen"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php the_content();?>
			</div>
		</article>	
	<?php endwhile; ?>
</table>
</div>

<?php get_footer(); // This fxn gets the footer.php file and renders it ?>
<? get_footer() ?>