<?php /* Template Name:Medios */ 

get_header(); 

$thumbID = get_post_thumbnail_id( $post->ID );
$imgDestacada = wp_get_attachment_url( $thumbID );

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

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/medios.css" media="screen" />

<section id="main-medios" class="blog">
	<header class="header-medios" style="background-image:url(<?php echo $imgDestacada?>)">
	<div id="jquery_jplayer_1" class="jp-jplayer"></div>
	<div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
	  <div class="jp-type-single">
	    <div class="jp-gui jp-interface">
	      <div class="jp-volume-controls">
	        <button class="jp-mute" role="button" tabindex="0">mute</button>
	        <button class="jp-volume-max" role="button" tabindex="0">max volume</button>
	        <div class="jp-volume-bar">
	          <div class="jp-volume-bar-value"></div>
	        </div>
	      </div>
	      <div class="jp-controls-holder">
	        <div class="jp-controls">
	          <button class="jp-play" role="button" tabindex="0">play</button>
	          <button class="jp-stop" role="button" tabindex="0">stop</button>
	        </div>
	        <div class="jp-progress">
	          <div class="jp-seek-bar">
	            <div class="jp-play-bar"></div>
	          </div>
	        </div>
	        <div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
	        <div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
	      </div>
	    </div>

	    <div class="jp-no-solution">
	      <span>Update Required</span>
	      To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
	    </div>
	  </div>
	</div>

		<hgroup>
			<h1 class="title"><?php the_title(); // Display the title of the post ?></h1>
		</hgroup>
		<div class="descrip-head">
			<?php while ( have_posts() ) : the_post(); ?>
			<p><?php the_content(); ?></p>
			<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
				
		</div>
	</header>
	<article class="post medios">
		
		<h2 class="cargando">Cargando...</h2>

	</article>
</section>
<script src="https://connect.soundcloud.com/sdk/sdk-3.0.0.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.jplayer.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/media.js"></script>
<?php get_footer(); // This fxn gets the footer.php file and renders it ?>