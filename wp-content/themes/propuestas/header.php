<?php
	/*-----------------------------------------------------------------------------------*/
	/*header
	/*-----------------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/favicon.ico" type="image/x-icon" />
<title>
	<?php bloginfo('name'); // show the blog name, from settings ?> | 
	<?php is_front_page() ? bloginfo('description') : wp_title(''); // if we're on the home page, show the description, from the site's settings - otherwise, show the title of the post or page ?>
</title>
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
 <!-- Load Facebook SDK for JavaScript -->
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; 
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <header class="main-header">
    <div class="col-md-8 col-sm-12 col-xs-12">  
      <div class="propuestas">
        <img src="<?php bloginfo('template_url'); ?>/img/propuestas-header.png?ver" alt="fotos de los concejales de Ciudad Futura">
      </div>
    
    </div>

    <div class="col-md-4 col-sm-12 col-xs-12">  
      <h1 class="cumplimos">Cumplimos</h1>
    </div>
  </header>