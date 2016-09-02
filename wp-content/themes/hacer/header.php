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
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
<title>
  <?php bloginfo('name'); // show the blog name, from settings ?> | 
  <?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
</title>

<?php wp_head(); 
// This fxn allows plugins, and Wordpress itself, to insert themselves/scripts/css/files
// (right here) into the head of your website. 
// Removing this fxn call will disable all kinds of plugins and Wordpress default insertions. 
// Move it if you like, but I would keep it around.
  $meses = array("0","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  $today = getdate();
  $month = $today['mon'];
  $lastmonth =  $month-1;
  if($_GET['mes']){
    $monthtowatch = $_GET['mes'];
    $GLOBALS['monthtowatch'] = $monthtowatch;
  }else{
  $monthtowatch = $lastmonth;
  $GLOBALS['monthtowatch'] = $monthtowatch;
  };
?>

 </head>
<body <?php body_class( 'class-name' ); ?>>
<header id="main-header">
  <div class="container">
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
      <img src="<?php  echo get_template_directory_uri(); ?>/img/logo.png" alt="">
      <h2><?php bloginfo('description');?></h2>
    </a>
    
    <hgroup>
      <h3><?php echo $meses[$monthtowatch]; ?> en Ciudad Futura</h3>
      <h4>Ver meses anteriores</h4>
    </hgroup>
    <ul class="meses"><?php wp_get_archives('type=monthly&limit=12'); ?></ul>
  </div>
</header>