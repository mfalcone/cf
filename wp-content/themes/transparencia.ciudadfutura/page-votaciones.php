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
<?php ?>
<?php $args = array( 'post_type' => 'votaciones', 'posts_per_page' => -1, 'meta_key'=>'_fecha_votaciones', 'orderby' => 'meta_value', 'order' => 'DESC'  );
	$loop = new WP_Query( $args );
	//print_r($loop);
	while ( $loop->have_posts() ) : $loop->the_post(); 
			$fecha = get_post_meta(get_the_ID(), '_fecha_votaciones', true); 
			$video = get_post_meta(get_the_ID(), 'videos_votaciones', true); 
			$totalafavor = get_post_meta(get_the_ID(), 'totalafavor', true); 
			$totalencontra = get_post_meta(get_the_ID(), 'totalencontra', true); 
			$totalabstencion = get_post_meta(get_the_ID(), 'totalabstencion', true); 
			$totalausente = get_post_meta(get_the_ID(), 'totalausente', true); 
			$concejales_totales = get_post_meta(get_the_ID(), 'concejales_totales', true); 
			if($totalafavor == ""){
				$totalafavor = "0";
			}
			if($totalencontra == ""){
				$totalencontra = "0";
			}
			if($totalabstencion == ""){
				$totalabstencion = "0";
			}
			if($totalausente == ""){
				$totalausente = "0";
			}
	?>

	<article class="votacion multivotaciones">
				
				<h1><a href="<?php the_permalink();?>"><span class="date"><?php echo date("d-m-Y", strtotime($fecha)); ?></span> <?php the_title();?></a></h1>
				<div class="content">
					<?php the_content(); ?>
				</div>
				<div class="video-wrapper">
					
					<?php 
					if($video){
						$strToEmbed = explode("?v=",$video);
						$iframeurl = "https://www.youtube.com/embed/".$strToEmbed[1];
					?>
					<iframe src="<?php echo $iframeurl; ?>" width="100%" height="350" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
					<?php }else{?>
						
						<img src="<?php bloginfo('template_directory'); ?>/img/taquigrafica.jpg" />

					<?php }?>

				</div>

				<?php echo do_shortcode('[votaciones afavor="'.$totalafavor.'" encontra="'.$totalencontra.'" abstenciones="'.$totalabstencion.'" ausentes="'.$totalausente.'"]') ?>

				<?php
				 //echo $concejales_totales;

				$obj=json_decode($concejales_totales);
				$afavor = array();
				$encontra = array();
				$abstencion = array();
				$ausente = array();

				//print_r($obj[0]->valor);
				foreach($obj as $votacion){
						if($votacion->valor=="afavor"){
							array_push($afavor,$votacion);
						}else if($votacion->valor=="encontra"){
							array_push($encontra,$votacion);
						}else if($votacion->valor=="abstencion"){
							array_push($abstencion,$votacion);
						}else if($votacion->valor=="ausente"){
							array_push($ausente,$votacion);
						};
					}
				?>
				<h3 class="vervotos">+ Ver Votaciones</h3>
				<div class="tablas ocultas">
					<div class="afavor col-md-3">
						<h2>A favor</h2>
						<ul>
							<?php foreach ($afavor as $concejal) {?>
								<li><?php echo $concejal->nombre; ?> <img src="<?php echo $concejal->img; ?>" alt="<?php echo $concejal->nombre; ?>"></li>
							<?php }?>
						</ul>
					</div>
					<div class="encontra  col-md-3">
						<h2>En Contra</h2>
						<ul>
							<?php foreach ($encontra as $concejal) {?>
								<li><?php echo $concejal->nombre; ?> <img src="<?php echo $concejal->img; ?>" alt="<?php echo $concejal->nombre; ?>"></li>
							<?php }?>
						</ul>
					</div>
					<div class="abstencion  col-md-3">
						<h2>Abstención</h2>
						<ul>
							<?php foreach ($abstencion as $concejal) {?>
								<li><?php echo $concejal->nombre; ?> <img src="<?php echo $concejal->img; ?>" alt="<?php echo $concejal->nombre; ?>"></li>
							<?php }?>
						</ul>
					</div>
					<div class="ausente  col-md-3">
						<h2>Ausentes</h2>
						<ul>
							<?php foreach ($ausente as $concejal) {?>
								<li><?php echo $concejal->nombre; ?> <img src="<?php echo $concejal->img; ?>" alt="<?php echo $concejal->nombre; ?>"></li>
							<?php }?>
						</ul>
					</div>
				</div>

			</article>


	<?php endwhile; ?>
</div>


<?php get_footer(); // This fxn gets the footer.php file and renders it ?>