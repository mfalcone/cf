<?php /* Template Name:Agenda */ 
get_header(); ?>
	<div class="agenda">
		<header>
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<div class="content">
						<?php the_content();?>
					</div>
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
			<?php endif;  ?>
		</header>
		<ul class="posteos">
			<?php 
			if ( current_user_can('organico') ){
				$args = array('post_type' => 'agenda',
							'posts_per_page' => -1, 
							'meta_key'=>'fecha_inicio', 
							'orderby' => 'meta_value', 
							'order' => 'DESC'  );
			}else{
				$args = array('post_type' => 'agenda',
							'posts_per_page' => -1, 
							'meta_query' => array(
							    
							    array(
							        'key'		=> 'nivel-usuario',
							        'compare'	=> '==',
							        'value'		=> '_ingresante',
							    )
						    ),
							'meta_key'=>'fecha_inicio', 
							'orderby' => 'meta_value', 
							'order' => 'DESC'  );
			}
			
		$loop = new WP_Query( $args );
		//print_r($loop);
		while ( $loop->have_posts() ) : $loop->the_post(); ?>
			<li>
			
			<?php 
			$fecha_inicio = get_post_meta(get_the_ID(), 'fecha_inicio', true); 
			$hora_inicio = get_post_meta(get_the_ID(), 'horario_inicio', true); 
			$fecha_fin = get_post_meta(get_the_ID(), 'fecha_fin', true); 
			$horario_fin = get_post_meta(get_the_ID(), 'horario_fin', true);
			?> 
			<h3><?php the_title(); ?></h3>
			<div class="date">
			inicio: <?php echo date("d/m", strtotime($fecha_inicio));?> - <?php echo $hora_inicio;?>hs. | 
			fin:<?php echo date("d/m", strtotime($fecha_fin));?> - <?php echo $horario_fin;?>hs.</div>
			
			<div class="content">
				<?php the_content();?>
			</div>
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
<? get_footer() ?>