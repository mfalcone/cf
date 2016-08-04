<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>

<div class="noticias">
<?php 
	$today = getdate();
	$month = $today['mon'];
	$lastmonth =  $month-1;
	$monthtowatch = $lastmonth;

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
				<h1><?php the_title(); ?></h1>
				<div class="excerpt">
				<h2><?php the_title(); ?></h2>
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
			<h1><?php the_title(); ?></h1>
			<?php the_excerpt(); ?>
			</div>
			</a>
		</div>
		<?php endwhile; ?>
	</section>
</div>
<section class="map-container">
	<div class="container">
	<h1>Ciudad Futura en los Barrios</h1>
	<?php $args = array( 'post_type' => 'seccionales', 'posts_per_page' => 1,'monthnum' =>$monthtowatch);
	$loop = new WP_Query( $args );

	while ( $loop->have_posts() ) : $loop->the_post(); 
		$exclude = array('_edit_last', '_wp_page_template', '_edit_lock');
		$meta = get_post_meta( get_the_ID() ); 
		?>
		<script type="text/javascript">
		var noticias = {	
		<?php	
			foreach( $meta as $key => $value ) {

				if( in_array( $key, $exclude) )
				    continue;
				?>
				<?php 
					$textToPrint = wpautop( $value[0], "<br>");
					$textToPrint = str_replace(array("\r", "\n"), '', $textToPrint);
				?>
				<?php echo $key;?>:"<?php echo $textToPrint;?>",
			         
			  <?php  }
			?>	
			}
		</script>
			

	<?php endwhile; ?>
		<?php get_template_part( 'map');?>
	</section>
<section class="container analisis">
	<?php $args = array( 'category_name' => 'analisis', 'posts_per_page' => 1,'monthnum' =>$monthtowatch);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_url( $thumbID );
	?>
	<a href="<?php the_permalink(); ?>">
	<img src="<?php echo $imgDestacada;?>" alt="<?php the_title(); ?>">
	<div class="meta">
		<h1><?php the_title(); ?></h1>
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
	<?php $args = array( 'category_name' => 'proyecto', 'posts_per_page' => 1,'monthnum' =>$monthtowatch);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_url( $thumbID );
	?>
	<a href="<?php the_permalink(); ?>">
	<div class="col-md-4">
		<?php the_post_thumbnail( 'alta-image' ); ?>
	</div>
	<div class="col-md-8">
		<h1><?php the_title(); ?></h1>
		<?php the_excerpt(); ?>
	</div>
	</a>
	<?php endwhile; ?>
</section
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>