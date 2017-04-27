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
			DONACIÓN AL INSTRUMENTO 76%
		</div>
		<div class="sueldo" style="width:30%">
			SUELDO NETO 24%
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="num_total col-md-4">
				<h4>$81.900</h4>
				<h5>SUELDO TOTAL<br></h5>
			</div>
			<div class="num_donacion col-md-4">
				<h4>$62.300</h4>
				<h5>DONACIÓN AL INSTRUMENTO</h5>
			</div>
			<div class="num_sueldo col-md-4">
				<h4>$19.600</h4>
				<h5>SUELDO NETO</h5>
			</div>
		</div>
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
	<div class="equidad">
		<div class="col-md-5 mujeres col-sm-12">
			<h2>10<br>Mujeres</h2>
		</div>
		<div class="col-md-1 col-sm-12">
			<img src="<?php bloginfo('template_url'); ?>/img/ellas.png" alt="ellas">
		</div>
		<div class="col-md-1 col-sm-12">
			<img src="<?php bloginfo('template_url'); ?>/img/ellos.png" alt="ellas">
		</div>
		<div class="col-md-5 varones col-sm-12">
			<h2>10<br>Varones</h2>
		</div>
		<div class="col-md-12 varones">
			<h3>Un equipo con paridad de género</h3>
			<hr>
		</div>
		
	</div>
<!--<div class="barras">
	<div class="col-md-8">
		<div class="total">
			SUELDO TOTAL 100%
		</div>
		<div class="donacion" style="width:50%">
			DONACIÓN AL INSTRUMENTO 50%
		</div>
		<div class="sueldo" style="width:50%">
			SUELDO NETO 50%
		</div>
	</div>
	<div class="col-md-4">
		<div class="row">
			<div class="num_total col-md-4">
				<h4>100%</h4>
				<h5>SUELDO TOTAL</h5>
			</div>
			<div class="num_donacion col-md-4">
				<h4>50%</h4>
				<h5>DONACIÓN AL INSTRUMENTO</h5>
			</div>
			<div class="num_sueldo col-md-4">
				<h4>$16.080</h4>
				<h5>SUELDO NETO</h5>
			</div>
		</div>
	</div>
	
</div>

<div class="col-md-8 cabecera-equipo">
<div style="position: relative; padding-bottom: 56.25%; height: 0;"><iframe style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;" src="https://www.youtube.com/embed/BL78uRLq1sY" width="100%" height="150" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>
</div>
<div class="col-md-4 cabecera-equipo">
	<h2>EQUIDAD DE GENERO</h2>
	<h4>El Equipo del Bloque Ciudad Futura está compuesto por 20 personas, de las cuales 10 son mujeres y 10 hombres. Todos profesionales, pero no de la política. En el video, el día a día de la oficina. Abajo, una pequeña bio de cada uno de ellas y ellos.
</h4>
</div>-->
<?php $args = array( 'post_type' => 'personas', 'posts_per_page' => -1, 'meta_query' => array (
		    array (
			  'key' => '_grupo',
			  'value' => '_concejales',
			  'compare' => 'NOT IN'
		    )
		  ),'order'=>'ASC');
	$loop = new WP_Query( $args );
	$index = 0;
	while ( $loop->have_posts() ) : $loop->the_post(); 
	$index++;
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
<?php 
	$res = $index % 4;
	if($res===1){
		$cortclase = "corte";
	}else{
		$cortclase = "nocorte";
	}
	?>
	<div class="equipo col-md-3 <?php echo $cortclase;?>">
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