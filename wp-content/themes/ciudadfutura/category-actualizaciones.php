<?php

get_header(); // This fxn gets the header.php file and renders it ?>

<div id="blog" class="content actualizaciones">
			<?php if ( have_posts() ) : 
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>

				<?php 
				$thumbID = get_post_thumbnail_id( $post->ID );
				$imgDestacada = wp_get_attachment_url( $thumbID );
				?>
					<section  class="post">
						<article style="background-image:url(<?php echo $imgDestacada?>)">
							
							<h1 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); // Display the title of the post ?></a></h1>
							<h2><?php echo get_the_excerpt(); ?> </h2>
							
						</article>
					</section>

				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
				
			


			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">No hay nada</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>