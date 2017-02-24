<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */

get_header(); // This fxn gets the header.php file and renders it ?>

<div class="noticias  fuego-lista">
<?php 
	/*$today = getdate();
	$month = $today['mon'];
	$lastmonth =  $month;
	*/
	$args = array('posts_per_page' => 12, 'meta_query' => array (
		    array (
			  'key' => '_posicion',
			  'value' => '_fuego',
		    )
		   ),'order'=>'DESC');
	$loop = new WP_Query( $args );
	//print_r($loop);
	while ( $loop->have_posts() ) : $loop->the_post(); 
		$thumbID = get_post_thumbnail_id( $post->ID );
		$imgDestacada = wp_get_attachment_url( $thumbID );
	?>

	<section class="col-md-4 " style="background-image:url(<?php echo $imgDestacada;?>)">
			<div class="nota">
				<div class="volanta"> <?php echo the_date("F Y"); ?></div>
				<?php 
					$anio = get_the_time("Y");
					$mes = get_the_time("m");
				?>
				<a href="<?php echo get_month_link($anio, $mes); ?>">
					<?php the_title(); ?>
				</a>

			</div>
	</section>
	<?php endwhile; ?>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>