<?php /* Template Name:Proyectos */ 

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
    <th class="tg-yw4l">Fecha</th>
    <th class="tg-yw4l">Título</th>
    <th class="tg-yw4l">Autor</th>
    <th class="tg-yw4l">Estado</th>
  </tr>

<?php $tags = get_tags(); ?>
<div class="tags">
<?php foreach ( $tags as $tag ) { ?>
    <span class="tag" data-href="<?php echo $tag->slug ; ?> " rel="tag"><?php echo $tag->name; ?></span>
<?php } ?>
</div>    

<?php $args = array( 'post_type' => 'proyectos', 'posts_per_page' => -1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); 


	$fecha = get_post_meta(get_the_ID(), '_proyecto', true); 
	$titulo = get_post_meta(get_the_ID(), '_titulo', true);
	$autor = get_post_meta(get_the_ID(), '_autor', true);
    $estado = get_post_meta(get_the_ID(), '_estado', true);
	$file = get_post_meta(get_the_ID(), '_file', true);
	
	
	switch ($estado) {
		case '_aprobado':
			$estado = "Aprobado";
			break;
		case '_en_comision':
			$estado = "En Comisión";
			break;
		case '_en_archivo':
			$estado = "En Archivo";
			break;
		case '_rechazado':
			$estado = "Rechazado";
			break;
		case '_despacho':
			$estado = "Despacho";
			break;
	}
?>
<?php 
	$posttags = get_the_tags();
?>

  <tr class="<?php if ($posttags) {foreach($posttags as $tag) {echo $tag->slug . ' '; }}	;?>">
    <td class="tg-yw4l"><?php echo $fecha ?></td>
    <td class="tg-yw4l"><?php if($file != ""){?><a href="<?php echo $file;  ?>" target="_blank"><?php echo $titulo ?></a><?php }else{ echo $titulo; }?></td>
    <td class="tg-yw4l"><?php echo $autor ?></td>
    <td class="tg-yw4l"><?php echo $estado;?></td>
  </tr>
	<?php endwhile; ?>
</table>
</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>