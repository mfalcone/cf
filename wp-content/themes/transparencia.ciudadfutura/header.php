<!DOCTYPE html><html>
<head>
  <meta charset='utf-8'>
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">
  <title><? wp_title() ?></title>
  <link rel="stylesheet" href="<? bloginfo('stylesheet_url') ?>" media="screen" />
  <link rel="shortcut icon" href="http://ciudadfutura.com.ar/wp-content/themes/ciudadfutura/img/ciudad-futura-favicon.ico?384979801"/>

	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery-2.2.0.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/d3.min.js"></script>

  <!--[if lt IE 9]><script src="<?= get_template_directory_uri(); ?>/js/html5shiv.js"></script><![endif]-->
  <? wp_head() ?>

<body <?php body_class(); ?>>
	<div class="menu-wrap">
		<div class="menulink">
			<span class="glyphicon glyphicon-align-justify"></span>
		</div>
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
	</div>
	<header>
				<div class="row">
					<div id="caren" class="concejal"></div>
					<div id="juan" class="concejal"></div>
					<div id="pitu" class="concejal"></div>
					<div class="col-md-4 pull-right cartel">
						<div class="cont-wrapper">
								<p class="ideas-acciones">
									IDEAS CLARAS <span class="glyphicon glyphicon-cloud"></span> <br>
									ACCIONES CONCRETAS <span class="glyphicon glyphicon-cloud-download"></span> 
								</p>
								<h2>DONAMOS EL 70% DE NUESTROS SUELDOS PARA MANTENER NUESTRA AUTONOMÍA FINANCIERA Y POLÍTICA</h2>
						</div>
					</div>
					
			</div>
	</header>
