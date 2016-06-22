<?php /* Template Name: Cargos */ 

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
<table class="table table-striped">
  <tr>
    <th class="tg-yw4l">Sesion</th>
    <th class="tg-yw4l">Institución</th>
    <th class="tg-yw4l">Territorio</th>
    <th class="tg-yw4l">Objetivo</th>
    <th class="tg-yw4l">Monto</th>
  </tr>

<?php $args = array( 'post_type' => 'subsidios', 'posts_per_page' => 4 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); 

	$sesion = get_post_meta(get_the_ID(), '_sesion', true); 
	$institucion = get_post_meta(get_the_ID(), '_institucion', true);
	$territorio = get_post_meta(get_the_ID(), '_territorio', true);
    $objetivo = get_post_meta(get_the_ID(), '_objetivo', true);
	$monto = get_post_meta(get_the_ID(), '_monto', true);
	
?>
  <tr>
    <td class="tg-yw4l"><?php echo $sesion ?></td>
    <td class="tg-yw4l"><?php echo $institucion ?></td>
    <td class="tg-yw4l"><?php echo $territorio ?></td>
    <td class="tg-yw4l"><?php echo $objetivo ?></td>
    <td class="tg-yw4l"><?php echo $monto ?></td>
  </tr>
	<?php endwhile; ?>
</table>
</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>