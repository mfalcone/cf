<?php /* Template Name:Tambo */ 

get_header(); 

$thumbID = get_post_thumbnail_id($post->ID);
$imgDestacada = wp_get_attachment_url( $thumbID );
query_posts('category_name=tambo&showposts=5');
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5&appId=667685589998815";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/tambo.css?05042016" media="screen" />

<div id="tambo" class="cssanimations">
<div class="cabecera-tambo"  style="background-image:url(<?php echo $imgDestacada?>)">
	
	<h1><?php the_title(); ?></h1>
</div>
<header>	
<ul class="lista">
<?php while (have_posts()) : the_post();?>

	<li>
		<a data-link="<?php the_ID();?>" href="<?php the_permalink() ?>" title="Permanent Link to <?php the_title(); ?>"><?php echo get_post_meta($post->ID, 'Boton', true); ?> </a>
	</li>
<?php endwhile;?>
</ul>
</header>
<?php while (have_posts()) : the_post();?>
<section id="<?php the_ID();?>" class="blog <?php if( in_category("inicial")){echo 'active';}?>
	">
	<article class="post">
	<h1><?php the_title(); // Display the title of the post ?></h1>	
	<div class="the-content">
			<?php the_content(); 
			// This call the main content of the post, the stuff in the main text box while composing.
			// This will wrap everything in p tags
			?>
			
	</div><!-- the-content -->
	</article>
</section>

<?php endwhile;?>
	<div class="social">
	<div class="fb-like" data-href="http://ciudadfutura.com.ar/momento_de_decidir/" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
	</div>
</div>

<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/tambo.js"></script>

<?php get_footer(); // This fxn gets the footer.php file and renders it ?>