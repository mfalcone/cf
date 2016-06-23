<?php /* Template Name:Aportes */ 

get_header(); // This fxn gets the header.php file and renders it ?>


			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>
	
				<div class="container">
						<div class="col-md-12 main-texto">
								<h1>
									<?php the_title(); ?>
								</h1>
								<?php the_content(); ?>
						</div>
				</div>
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
		
			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">No hay nada</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
<div class="container">
	<iframe src="https://docs.google.com/forms/d/1jcJPcixj0StcZOZEAVDlsDlzXNTHZSXatURwUe23zn8/viewform?embedded=true" width="100%" height="1920" frameborder="0" marginheight="0" marginwidth="0">Cargando...</iframe>
</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>