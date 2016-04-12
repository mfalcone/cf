<?php /* Template Name:Bloque */ 

get_header(); // This fxn gets the header.php file and renders it ?>
<div id="main-bloque">
			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>

						
						<div class="the-content-bloque">
							<?php the_content(); 
							// This call the main content of the post, the stuff in the main text box while composing.
							// This will wrap everything in p tags
							?>
							
						</div><!-- the-content -->
						
						
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
				
			


			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">No hay nada</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
</div>
<script>
	  $(document).ready(function(){
	  	 if (!window.matchMedia('(max-width: 768px)').matches){

			      $(".the-content-bloque").onepage_scroll({
			        sectionContainer: "article",
			        responsiveFallback: 600,
			        loop: true
			      });

	  		}
		});
		
	</script>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>