<?php /* Template Name:Quiero Ayudar */ 
get_header(); 

function my_bp_get_users_by_xprofile( $field_id, $value ) {
 
global $wpdb;
$hoy = date('Y-m-d');
$result = $wpdb->get_results('SELECT * FROM  wp_bp_xprofile_data WHERE field_id = 3 AND DATE_FORMAT(value,"%m-%d") = DATE_FORMAT("'.$hoy.'","%m-%d")');

print_r($result); // display data
}

my_bp_get_users_by_xprofile( 6, 'homeros' );
//print_r($user_ids);
?>




			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>
	
				<div class="row">
						<div class="col-md-12">
								<h1>
									<?php the_title(); ?>
								</h1>
								<div class="col-md-12 quiero-img">
									<?php 
										if ( has_post_thumbnail() ) {
											the_post_thumbnail('large');
										}
									?>
								</div>
								<div class="col-md-12">
									<?php the_content(); ?>
								</div>
								
								<div class="quiero">
									<?php echo do_shortcode('[quiero-ayudar]');?>
								</div>
						</div>
				</div>
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
		
			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
<div class="row quiero-ayudar-posts">

	<?php 
	//'meta_key'=>'_proyecto', 'orderby' => 'meta_value',
	$args = array( 'category_name' => 'quiero_ayudar', 'posts_per_page' => -1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); ?>
		<article>
			<h1><?php the_title(); ?></h1>
			<div class="contenido">
				<div class="imagen"><?php the_post_thumbnail( 'large' ); ?></div>
				<?php the_content();?>
				<?php comments_template(); ?>
			</div>
		</article>	
	<?php endwhile; ?>
</div>

<?php get_footer(); // This fxn gets the footer.php file and renders it ?>
<? get_footer() ?>