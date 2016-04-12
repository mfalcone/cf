<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>

<div id="main" class="content search">
			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>
				 <header class="page-header">
                    <h1 class="page-title"><?php printf( __( 'Resultados de: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header>
				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>

					<article class="post">
					
						<h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); // Display the title of the post ?></a></h2>
						<div class="content">		
						<?php
						$string =  $post->post_content;
						$newString = substr($string, 0, 80);
						echo $newString."...";
						?>
						</div>
					</article>

				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
				
			


			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">No hay nada</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>