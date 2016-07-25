<?php /* Template Name: Votaciones */ 

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
<?php 
$args = array(
    'category_name' => 'votaciones'
);
$category_query = new WP_Query($args);

if ($category_query->have_posts()) {
    while ($category_query->have_posts()) {
        $category_query->the_post();
        ?>
        <div class="votacion">
        <h2><span class="fecha"><?php  echo get_post_meta(get_the_ID(), 'fecha', true); ?></span> <?php the_title(); ?></h2>
        <div><?php the_content(); ?></div>
        </div>
        <?php
    }
} else {
    ?>
    nada
    <?php
}?>

</div>


<?php get_footer(); // This fxn gets the footer.php file and renders it ?>