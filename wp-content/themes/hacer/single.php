<?php
/**
 * The template for displaying the home/index page.
 * This template will also be called in any case where the Wordpress engine 
 * doesn't know which template to use (e.g. 404 error)
 */


get_header(); // This fxn gets the header.php file and renders it ?>

<section class="container single">
			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post();
					$monthtowatch = $GLOBALS['monthtowatch'];
					$thumbID = get_post_thumbnail_id( $post->ID );
					$imgDestacada = wp_get_attachment_url( $thumbID );
					$layout = get_post_meta( get_the_ID(), 'layout', true ); 
					
					if(in_category('seccionales')){?>
					<div id="map-wrapper">
					<div class="image-wrapper"><img src="<?php echo $imgDestacada; ?>" alt=""></div>
					<div class="epigrafe"><?php the_excerpt();?></div>
			    	<h2><?php the_title();?></h2>
					<div class="contenido">
						<?php the_content(); ?>
					</div>
					</div>
					<?php } else{
						if($layout=="dos-columnas"){?>

						 		<div class="col-md-12">	
						 			<h1 class="dos-col-title"><?php the_title();?></h1>
						 			<div class="col-md-6 dos-col-texto">
							 			<div class="expert">
											<?php the_excerpt(); ?>
										</div>
										<div class="content">
						 					<?php the_content();?>
						 				</div>
						 			</div>
						 			<div class="col-md-6">
						 				<img src="<?php echo $imgDestacada; ?>" alt="">
						 			</div>
						 		</div>
						 	<?php }else{
						 ?>
							<?php 
								$current_post_id = $post->ID; 
								?>
						<div class="col-md-12">			
							<div class="image-wrapper"><img src="<?php echo $imgDestacada; ?>" alt=""></div>
							<h1><?php the_title();?></h1>
							<div class="expert">
								<?php the_excerpt(); ?>
							</div>
							<div class="content">
								<?php the_content();?>
							</div>
						</div>
						<?php }?>
					<?php }?>
							<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>

		<?php endif; ?>
</section>
<div class="aside-wrapp">
	<div class="aside col-md-12">
	<h2>Otras noticias del mes</h2>
	<ul>
		<?php 	
				$contador = 0;
				$monthtowatch = $GLOBALS['monthtowatch'];
				$args = array('posts_per_page' => 4, 'monthnum' =>$monthtowatch, 'meta_query' => array (
					'relation' => 'OR',
					    array (
						  'key' => '_posicion',
						  'value' => '_fuego',
						   'compare' => '='
					    ),
					    array (
						  'key' => '_posicion',
						  'value' => '_alta',
						   'compare' => '='
					    )
					   ),'order'=>'ASC');
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); 
				
				if($current_post_id != $post->ID) {?>
					<li>
					<a href="<?php the_permalink();?>">
					<?php the_post_thumbnail( 'alta-image' ); ?>
					<?php the_title();?>
					</a>	
					</li>
				<?php
					$contador++;
					}?>
			<?php endwhile; 
			if($contador==3){

				$args = array( 'category_name' => 'proyecto', 'posts_per_page' => 1,'monthnum' =>$monthtowatch);
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post();?>
				<li>
					<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'alta-image' ); ?>
					<?php the_title();?>
					</a>
				</li>
				<?php endwhile; ?>
			<?php }?>

			</ul>
	</div>
</div>
<?php get_footer(); // This fxn gets the footer.php file and renders it 

?>