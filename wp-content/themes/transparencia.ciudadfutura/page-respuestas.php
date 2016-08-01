<?php /* Template Name: Respuestas */ 

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
<?php $args = array( 'post_type' => 'respuesta', 'posts_per_page' => -1);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); 


	$nota = get_post_meta(get_the_ID(), '_nota', true); 
	$fecha_respuesta = get_post_meta(get_the_ID(), '_fecha_respuesta', true);
	$categoria = get_post_meta(get_the_ID(), '_categoria', true);
    $desarrollo = get_post_meta(get_the_ID(), '_desarrollo', true);
    $concepto = get_post_meta(get_the_ID(), '_concepto', true);
	
	$categorias = explode(",", $categoria);
	//print_r($categorias);
	?>

	<article class="respuesta">
	<h2><a href=" <?php the_permalink() ?>"> <?php the_title() ?></a></h2>
		<dl class="encabezado">
			<dt>Fecha de publicación:</dt>
			<dd><?php echo date("d/m/Y", strtotime($fecha_respuesta));?></dd>
			<dt>Nota:</dt>
			<dd><?php echo $nota;?></dd>
			<dt>Concepto:</dt>
			<dd><?php echo $concepto;?></dd>
		</dl>
		<p class="categoria">
		<?php foreach ($categorias as $cat){?>
				<span class="cat <?php echo strtolower($cat); ?>"> <?php echo $cat; ?></span>
		<?php }?>	
		</p>
		
		<dl class="desarrollo">
			<dt><span class="glyphicon glyphicon-chevron-down"></span> Ver mas:</dt>
			<dd><?php echo wpautop($desarrollo,true);?></dd>
		</dl>	
		
	</article>
	<?php endwhile; ?>
</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>