<?php /* Template Name:Home */ ?>

<!DOCTYPE html>
<html class="html" lang="es-ES">
 <head>

	<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
	<meta name="description" content="GENTE COMUN HACIENDO COSAS FUERA DE LO COMUN.
Acá vas a encontrar toda la información y una actualización constante del desarrolo y consolidación de Ciudad Futura como alternativa política en la ciudad de Rosario. Desde los 90 mil votos y la conformación del Bloque Ciudad Futura hasta los modos de sumarte a militar. "/>
	<meta name="keywords" content="Juan Monteverde, Pedro Salinas, Caren Tepp, Ciudad Futura, Nuevo Alberdi, Villa Moreno, Tambo La Resistencia, Triple Crimen de villa Moreno, Jere, Mono y Patóm, Escuela ETICA, Misión Anti Inflación, Distrito Siete, Autonomía política, Prefiguración, Socialismo de Siglo XXI, Izquierda, Elecciones Rosario 2015, Eleciones Santa Fe 2015, desalojos, Narcotráfico, Ley de Víctimas, #CiudadFutura, HACER, Monteverde, Frente Ciudad Futura, FCF, Giros Rosario, FPDS Rosario, Bloque Ciudad Futura, Concejales Rosario, Concejo Municipal de Rosario, Batacazo Ciudad Futura, Sorpresa elecciones Rosario "/>
	<meta name="viewport" content="width=device-width, user-scalable=no">
	<link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/img/ciudad-futura-favicon.ico?384979801"/>
	<title>Ciudad Futura</title>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/home.css">
	<script src="<?php bloginfo('template_directory');?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="<?php bloginfo('template_directory');?>/js/ciudadfutura.js" type="text/javascript"></script>
	<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-75871000-1', 'auto');
  ga('send', 'pageview');

</script>
 </head>
<body <?php body_class( 'class-name' ); ?>>

<header>
	<h1>Hacer. Ciudad Futura</h1>
	<h2>Gente Común haciendo cosas fuera de lo común</h2>
	<h3>- Eso es Ciudad Futura - </h3>
</header>

<?php $walker = new Menu_With_Description; ?>
<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav-menu', 'walker' => $walker ) ); ?>

<video id="bgvid" preload="auto" autoplay="true" loop="loop" muted="muted" volume="0"> 
<source src="<?php bloginfo('template_directory');?>/assets/fondo_web.webm" type="video/webm"> 
<source src="<?php bloginfo('template_directory');?>/assets/fondo_web.mp4" type="video/mp4"> 
This browser does not happen to support video</video>
	

<div class="slideshow"></div>




<div class="social-footer">
	<div id="fb-root"></div>
	<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	<div class="fb-like" data-href="http://www.ciudadfutura.com.ar/index.html" data-send="true" data-width="319" data-show-faces="false" data-colorscheme="light" data-layout="button_count" data-action="like"></div>
	<a href="https://twitter.com/movimientogiros" class="twitter-follow-button" data-lang="es" data-show-screen-name="false" data-size="medium"></a>
	<a href="https://twitter.com/share" class="twitter-share-button" data-count="true" data-lang="es" data-url="www.ciudadfutura.com.ar/index.html" data-size="medium" data-text="www.ciudadfutura.com.ar" data-related=""></a>

	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
</div>
	<?php wp_footer(); 
// This fxn allows plugins to insert themselves/scripts/css/files (right here) into the footer of your website. 
// Removing this fxn call will disable all kinds of plugins. 
// Move it if you like, but keep it around.
?>
	<!-- JS includes -->
 

	 </body>
</html>
