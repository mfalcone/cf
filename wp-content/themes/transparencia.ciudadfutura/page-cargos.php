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
<h2>Concejales</h2>
<div class="barras">
	<div class="col-md-8">
		<div class="total">
			SUELDO TOTAL 100%
		</div>
		<div class="donacion" style="width:70%">
			DONACIÓN AL INSTRUMENTO 70%
		</div>
	</div>
	<div class="num_total col-md-2">
		<h4>100%</h4>
		<h5>SUELDO TOTAL</h5>
	</div>
	<div class="num_donacion col-md-2">
		<h4>70%</h4>
		<h5>DONACIÓN AL INSTRUMENTO</h5>
	</div>
</div>
<?php $args = array( 'post_type' => 'personas', 'posts_per_page' => -1, 'meta_query' => array (
		    array (
			  'key' => '_grupo',
			  'value' => '_concejales',
		    )
		   ),'order'=>'ASC');
	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post(); 

	$nombre = get_post_meta(get_the_ID(), '_nombre', true); 
	$imagen = get_post_meta(get_the_ID(), '_imagen', true);
	$mail = get_post_meta(get_the_ID(), '_mail', true);
    $bio = get_post_meta(get_the_ID(), '_bio', true);
	$grupo = get_post_meta(get_the_ID(), '_grupo', true);
	
?>
<div class="concejales col-md-4">
	<img src="<?php echo $imagen;?>" alt="foto de <?php echo $nombre;?>" />
	<h3><?php echo $nombre;?></h3>
	<p class="mail"><?php echo $mail;?></p>
	<p class="bio"><?php echo $bio;?></p>
</div>
	<?php endwhile; ?>


<h2>Equipo Concejales</h2>
<div class="barras">
	<div class="col-md-8">
	<div class="total">
		SUELDO TOTAL 100%
	</div>
	<div class="donacion" style="width:50%">
		DONACIÓN AL INSTRUMENTO 50%
	</div>
</div>
<div class="num_total col-md-2">
	<h4>100%</h4>
	<h5>SUELDO TOTAL</h5>
</div>
<div class="num_donacion col-md-2">
	<h4>50%</h4>
	<h5>DONACIÓN AL INSTRUMENTO</h5>
</div>
</div>

<?php $args = array( 'post_type' => 'personas', 'posts_per_page' => -1, 'meta_query' => array (
		    array (
			  'key' => '_grupo',
			  'value' => '_concejales',
			  'compare' => 'NOT IN'
		    )
		  ),'order'=>'ASC');
	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post(); 

	$nombre = get_post_meta(get_the_ID(), '_nombre', true); 
	$imagen = get_post_meta(get_the_ID(), '_imagen', true);
	$mail = get_post_meta(get_the_ID(), '_mail', true);
    $bio = get_post_meta(get_the_ID(), '_bio', true);
	$grupo = get_post_meta(get_the_ID(), '_grupo', true);
	switch ($grupo) {
		case '_secretarios':
			$grupo = 'Equipo Gobierno';
			$clase = 'gobierno';
		break;
		case '_politica':
			$grupo = 'Equipo Políticas Públicas';
			$clase = 'politica';
		break;
		case '_comunicacion':
			$grupo = 'Equipo Comunicación';
			$clase = 'comunicacion';
		break;
	}
?>
<div class="equipo col-md-3">
	<img src="<?php echo $imagen;?>" alt="foto de <?php echo $nombre;?>" />
	<h3><?php echo $nombre;?></h3>
	<p class="mail"><?php echo $mail;?></p>
	<hr class="<?php echo $clase; ?>">
	<p class="grupo"><?php echo $grupo;?></p>
	<span class="glyphicon glyphicon-plus <?php echo $clase; ?>"></span>
	<p class="bio">
		<?php echo $bio;?>
	</p>
</div>
	<?php endwhile; ?>
</div>


<?php get_footer(); // This fxn gets the footer.php file and renders it ?>