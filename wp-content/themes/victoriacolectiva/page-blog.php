<?php /* Template Name:Blog */ 
get_header(); ?>
	<div class="blog">
		<header>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<div class="content">
						<?php the_content();?>
					</div>
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
			<?php endif;  ?>
			<div class="bt"><span class="escribir">Escribir</span></div>
		</header>
		<div class="editor">
			<?php echo do_shortcode('[wpuf_form id="71"]'); ?>
		</div>
		<section class="posteos">
			<?php
			$args = array( 'category_name' => 'foto_del_dia', 'posts_per_page' => -1 );
			$loop = new WP_Query( $args );
			$counter = 0;
			while ( $loop->have_posts() ) : $loop->the_post(); $counter++; ?>
			<article class="fotos <?php if( $counter % 2 == 0 ) { //It's even?>odd<?php }else{?>even<?php }?>">
				<div class="contenido col-md-6">
					<h2><?php the_title(); ?></h2>
					<div class="autor">Creada por <?php the_author();?></div>
					<?php the_content(); ?>
				</div>
				<div class="foto col-md-6">
					<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('large');
						}
					?>
				</div>
				<?php
				$user_id = get_current_user_id();
				$userpost = $post->post_author;
				if ($user_id == $userpost){  ?>
				<a href="<?php  echo get_home_url();?>/edit/?pid=<?php echo $post->ID?>">editar</a>
				<?php	}?>
			</article>
			<?php endwhile; // end of the loop. ?>
		</section>
	</div>
<? get_footer() ?>