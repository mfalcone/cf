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

<?php wp_head(); 
// This fxn allows plugins, and Wordpress itself, to insert themselves/scripts/css/files
// (right here) into the head of your website. 
// Removing this fxn call will disable all kinds of plugins and Wordpress default insertions. 
// Move it if you like, but I would keep it around.
?>

 </head>
<body <?php body_class( 'class-name' ); ?>>
<header id="main-header">
  <div class="container">
    <h1><?php bloginfo('name');?></h1>
    <h1><?php bloginfo('description');?></h1>
    <div class="meses"><?php wp_get_archives('type=monthly&limit=12'); ?></div>
  </div>
</header>