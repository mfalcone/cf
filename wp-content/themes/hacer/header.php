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
    if(get_query_var('monthnum')){
      $mesnum = get_query_var('monthnum');
      $mesencuestion = $meses[$mesnum];
      $GLOBALS['monthtowatch'] = $mesnum;
    }else{
      $mesnum = $lastmonth;
      $mesencuestion =  $meses[$mesnum];
       $GLOBALS['monthtowatch'] = $mesnum;
    };
}
?>

 </head>
<body <?php body_class( 'class-name' ); ?>>
<header id="main-header">
  <div class="container">
    <?php if (!is_home()):  ?>
    <div class="col-md-4 col-xs-4 vertical">
      <?php if (!is_singular('post')) :?>
      <h3><?php echo  $mesencuestion; ?> en Ciudad Futura</h3>
      <?php else:
      while ( have_posts() ) : the_post();?>
        <h3><?php echo  get_the_time("F");?> en Ciudad Futura</h3>
      <?php endwhile; ?>
      <?php endif;?>
    </div>
    <?php endif; ?>
    <div class="col-md-4 col-xs-3">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="main-link">
        <img src="<?php  echo get_template_directory_uri(); ?>/img/logo.png" alt="">
      </a>
    </div>
    <div class="col-md-4 col-xs-5  vertical <?php if (is_home()):  ?>col-md-offset-4 col-xs-offset-4<?php endif;?>">
      <div class="row">
        <div class="col-md-8 col-xs-6">
          <h4>Ver todos los meses</h4>
        </div>
        <div class="col-md-4  col-xs-6 form-wrap">
          <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
              <input type="search" class="search-field" placeholder="Buscar …" value="" name="s" title="Buscar" />
              <button type="submit" class="btn">
                <span class="glyphicon glyphicon-search"></span>
              </button>
          </form>
        </div>
      </div>
    </div>
    <ul class="meses"><?php wp_get_archives('type=monthly&limit=12'); ?></ul>
  </div>
</header>