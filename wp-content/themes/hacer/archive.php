<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it 

$monthnum = get_query_var('monthnum');
$year     = get_query_var('year');
$meses = array("0","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

?> 

<h1 class="nombremes"><?php echo $meses[$monthnum];?> de <?php echo $year;?></h1>
<div class="noticias">
<?php 
	$monthtowatch = $monthnum;

	$args = array('posts_per_page' => 1, 'monthnum' =>$monthtowatch, 'meta_query' => array (
		    array (
			  'key' => '_posicion',
			  'value' => '_fuego',
		    )
		   ),'order'=>'ASC');
	$loop = new WP_Query( $args );
	//print_r($loop);
	while ( $loop->have_posts() ) : $loop->the_post(); 
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_url( $thumbID );
	?>
		<section class="fuego" style="background-image:url(<?php echo $imgDestacada;?>)">
			<div class="nota">
			<?php $volanta = get_post_meta( get_the_ID(), 'volanta', true ); 
				if($volanta){ ?>
					<div class="volanta"><div class="container"><?php echo $volanta; ?></div></div>
			<?php }
			?>

			<a href="<?php the_permalink();?>">
				<div class="container">
				<h1><?php the_title(); ?></h1>
				<div class="excerpt"><?php the_excerpt(); ?></div>
				</div>
				</a>

			</div>
	</section>
	<?php endwhile; ?>
	<section class="container alta-container">
	<?php
		$args = array('posts_per_page' => 3, 'monthnum' =>$monthtowatch, 'meta_query' => array (
			    array (
				  'key' => '_posicion',
				  'value' => '_alta',
			    )
			   ),'order'=>'ASC');
		$loop = new WP_Query( $args );
		//print_r($loop);
		while ( $loop->have_posts() ) : $loop->the_post(); 
		?>
		<div class="alta col-md-4">
			<a href="<?php the_permalink();?>">
				<?php the_post_thumbnail( 'alta-image' ); ?>
				<h2><?php the_title(); ?></h2>
				<div class="excerpt">
				<?php the_excerpt(); ?>
				</div>
			</a>
		</div>
		<?php endwhile; ?>
	</section>
	<section class="container">
	<?php
		$args = array('posts_per_page' => -1, 'monthnum' =>$monthtowatch, 'meta_query' => array (
			    array (
				  'key' => '_posicion',
				  'value' => '_media',
			    )
			   ),'order'=>'ASC');
		$loop = new WP_Query( $args );
		//print_r($loop);
		while ( $loop->have_posts() ) : $loop->the_post(); 
			$thumbID = get_post_thumbnail_id( $post->ID );
			$imgDestacada = wp_get_attachment_url( $thumbID );
		?>
		<div class="media col-md-6">
		<a href="<?php the_permalink();?>">
			<div class="col-md-6"><?php the_post_thumbnail( 'media-image' ); ?></div>
			<div class="col-md-6 nota">
			<h2><?php the_title(); ?></h2>
			<?php the_excerpt(); ?>
			</div>
			</a>
		</div>
		<?php endwhile; ?>
	</section>
</div>
<!--section class="map-container">
	<div class="container">
	<h1>Ciudad Futura en los Barrios</h1>
	<p>Clickeá sobre cada seccional para conocer las actividades del mes en todos los puntos de la ciudad.</p>
	<script type="text/javascript">
		var url = "<?php echo get_site_url(); ?>"
		var mesactual = <?php echo $monthtowatch; ?>;
		var anio = "<?php echo date("Y"); ?>"
	</script>
	<?php get_template_part( 'map');?>
	</div>
</section-->
<section class="container analisis">
	<?php $args = array( 'category_name' => 'analisis', 'posts_per_page' => 1,'monthnum' =>$monthtowatch);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_url( $thumbID );
	?>
	<a href="<?php the_permalink(); ?>">
	<h1><?php the_title(); ?></h1>
	<img src="<?php echo $imgDestacada;?>" alt="<?php the_title(); ?>">
	<div class="meta">
		<div class="excerpt">
			<div class="inner-excerpt">
				<?php the_excerpt(); ?>
			</div>
		</div>
	</div>
	</a>
	<?php endwhile; ?>
</section>
<section class="container proyecto">
	<?php $args = array( 'category_name' => 'proyecto', 'posts_per_page' => 2,'monthnum' =>$monthtowatch);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_url( $thumbID );
	?>
	<div class="inner-proyecto">
	<a href="<?php the_permalink(); ?>">
	<div class="col-md-4">
		<?php the_post_thumbnail( 'alta-image' ); ?>
	</div>
	<div class="col-md-8">
		<h1><?php the_title(); ?></h1>
		<?php the_excerpt(); ?>
	</div>
	</a>
	</div>
	<?php endwhile; ?>
</section>
<section class="container humor">
	<?php $args = array( 'category_name' => 'humor', 'posts_per_page' => 1,'monthnum' =>$monthtowatch);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_url( $thumbID );
	?>
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>
	<?php endwhile; ?>
</section>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>