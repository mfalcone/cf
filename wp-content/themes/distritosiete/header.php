<?php
  /*-----------------------------------------------------------------------------------*/
  /* This template will be called by all other template files to begin 
  /* rendering the page and display the header/nav
  /*-----------------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title>
  <?php bloginfo('name'); // show the blog name, from settings ?> | 
  <?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
</title>
<link rel="shortcut icon" href="<?php bloginfo('template_directory');?>/img/ciudad-futura-favicon.ico?384979801"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url');?>">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory');?>/css/jquery.fancybox.css">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // We are loading our theme directory style.css by queuing scripts in our functions.php file, 
  // so if you want to load other stylesheets,
  // I would load them with an @import call in your style.css
?>

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); 
// This fxn allows plugins, and Wordpress itself, to insert themselves/scripts/css/files
// (right here) into the head of your website. 
// Removing this fxn call will disable all kinds of plugins and Wordpress default insertions. 
// Move it if you like, but I would keep it around.
?>

  <script src="<?php bloginfo('template_directory');?>/js/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/jquery.onepage-scroll.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_directory');?>/js/ciudadfutura.js"></script>
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
<header id="main-header">
<div class="icon"></div>
<?php $walker = new Menu_With_Description; ?>
<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav-menu', 'walker' => $walker ) ); ?>
<h1><a href="<?php echo get_site_url(); ?>">Ciudad Futura</a></h1>
<?php wp_nav_menu( array( 'theme_location' => 'social-menu', 'menu_class' => 'social-menu') ); ?>
<?php get_search_form(); ?>
</header>