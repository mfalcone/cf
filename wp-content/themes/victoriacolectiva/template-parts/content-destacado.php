<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package victoriacolectiva
 */
		$autor = get_post_meta(get_the_ID(), '_autor', true); 
		$vinculo = get_post_meta(get_the_ID(), '_vinculo', true); 
		$img = get_post_meta(get_the_ID(), '_img', true);
		$razon = get_post_meta(get_the_ID(), '_justificacion', true);
	?>
<div id="page">
	<div class="row destacados">
			<article>
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<div class="row">
			<div class="bajo-titulo col-md-7">
				<img src="<?php echo $img; ?>" alt="<?php echo $autor;?>"/>
				<span>Por <?php echo $autor;?></span>
			</div>
			<div class="social col-md-5">
				
			<div class="fb-like" data-href="<?php the_permalink();?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://google.com">Tweet</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
			</div>
			</div>
			<blockquote> 
				<p><?php echo $razon;?></p>
			</blockquote> 
			<div class="contenido">
				<?php the_content();?>
			</div>
			<p class="participa"><a href="<?php echo $vinculo ?>">participá</a></p>
		</article>	
	</div>
</div>