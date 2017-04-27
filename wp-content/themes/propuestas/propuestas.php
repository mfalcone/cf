<div class="propuestas">
	<?php $args = array( 'post_type' => 'propuesta', 'posts_per_page' => -1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); ?>
	<article class="col-lg-3 col-md-4 col-sm-6 col-xs-12" id="elem-<?php the_id();?>">
		<div class="card">
			<div class="front"><?php the_post_thumbnail( 'full' );?></div>
			<div class="back">
				<h2><span class="fa fa-check-square-o"></span><?php the_title();?></h2>
				<div class="que-es">
					<h3>¿Qué es?</h3>
					<?php 
						$que_es = get_post_meta(get_the_ID(), '_que_es', true); 
						echo $que_es;
					?>
				</div>
				<div class="para-que-sirve">
					<h3>¿Para qué sirve?</h3>
					<?php 
						$para_que_sirve = get_post_meta(get_the_ID(), '_para_que_sirve', true); 
						echo $para_que_sirve		
					?>
				</div>
				<div class="ejemplo">
					<h3>Ejemplo</h3>
					<?php 
						$ejemplo = get_post_meta(get_the_ID(), '_ejemplo', true); 
						echo $ejemplo;
					?>
				</div>
				<div class="link">
					<?php 
						$link_ordenanza = get_post_meta(get_the_ID(), '_link_ordenanza', true); 
					?>
					<span class="fa fa-newspaper-o"></span><a href="<?php echo $link_ordenanza; ?>" target="_blank">LEER PROYECTO DE ORDENANZA</a>
				</div>
				<div class="social-share">
					<a href="whatsapp://send?text=<?php the_title(); ?> – <?php the_permalink(); ?>" data-action="share/whatsapp/share" class="hidden-md hidden-lg">Compartir en WhatsApp</a>
					<a class="tgme_action_button hidden-md hidden-lg" href="tg://msg_url?url=<?php the_permalink(); ?>">Compartir en Telegram</a>

					<div class="fb-share-button" data-href="<?php the_permalink();?>" data-layout="button_count"></div>
					<div class="twiter">
					<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink();?>">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
					</div>
				</div>
			</div>
		</div>
	</article>
	<?php endwhile; // end of the loop. ?>
</div>