<?php 
// Ruta de la imagen destacada (tamaño completo)
$thumbID = get_post_thumbnail_id( $post->ID );
$imgDestacada = wp_get_attachment_url( $thumbID );
?>
<section class="blog">
<header class="blog" style="background-image:url(<?php echo $imgDestacada?>)">
	<hgroup>
	<h1 class="title"><?php the_title(); // Display the title of the post ?></h1>
	<h2><?php the_excerpt(); ?> </h2>
	<h3><?php the_date(); ?></h3>
	</hgroup>
</header>

<article class="post">
	
	<div class="the-content">
		<?php the_content(); 
		// This call the main content of the post, the stuff in the main text box while composing.
		// This will wrap everything in p tags
		?>
		
	</div><!-- the-content -->
	
	
</article>
</section>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/blog.js"></script>
