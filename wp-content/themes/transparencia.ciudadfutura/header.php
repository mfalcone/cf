<!DOCTYPE html><html>
<head>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
  <title><? wp_title() ?></title>
  <link rel="stylesheet" href="<? bloginfo('stylesheet_url') ?>" media="screen" />
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/d3.min.js"></script>

  <!--[if lt IE 9]><script src="<?= get_template_directory_uri(); ?>/js/html5shiv.js"></script><![endif]-->
  <? wp_head() ?>

<body>
	<div class="container">
	<?php //wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'menu-header' ) ); ?>
<?php /* Primary navigation */
wp_nav_menu( array(
  'menu' => 'top_menu',
  'depth' => 2,
  'container' => false,
  'menu_class' => 'nav nav-justified',
  //Process nav menu using our custom nav walker
  'walker' => new wp_bootstrap_navwalker())
);
?>

</div>
	<header>
				<div class="row">
					<div class="col-md-4 pull-right">
							<h2>DONAMOS EL 70% DE NUESTROS SUELDOS PARA MANTENER NUESTRA AUTONOMÍA</h2>
					</div>
					
			</div>
	</header>
