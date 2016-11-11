<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package victoriacolectiva
 */

get_header(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.8&appId=667685589998815";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		
		while ( have_posts() ) : the_post();
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('medium');
			}
			$posttype =  get_post_type();
			if($posttype=="contenido-destacado"){
				get_template_part( 'template-parts/content', 'destacado' );
			}else{
				get_template_part( 'template-parts/content', get_post_format() );
			}?>
			<?php comments_template(); ?>
		<?php endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
