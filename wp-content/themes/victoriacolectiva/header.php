<?php

/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package victoriacolectiva
 */
 if(!is_user_logged_in()){
	if(!is_front_page() && !is_page('registrar')){
		wp_redirect(home_url());
	}
}


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
		<?php if ( current_user_can('organico') ) : ?>
		<?php endif; ?>
	<header id="masthead" class="site-header" role="banner">
		<div class="cf-icon">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"></a>
		</div><!-- .site-branding -->
		<div class="user">
			<?php 
				global $current_user;
				$username = $current_user->user_login;
				echo $username;
			?>
			<?php bp_loggedin_user_avatar( 'width=' . bp_core_avatar_thumb_width() . '&height=' . bp_core_avatar_thumb_height() ); ?>
			<a href="<?php echo wp_logout_url(home_url()); ?>">Salir <span class="glyphicon glyphicon-off"></span></a>
		</div>
	</header><!-- #masthead -->
	<?php if(is_user_logged_in()):?>
	<aside id="sidebar">
		<ul id="main-menu">
			<li><a href="<?php echo get_home_url(); ?>/actividad"><span class="glyphicon glyphicon-flag"></span></a></li>
			<li><a href="<?php echo get_home_url(); ?>/info-basica"><span class="glyphicon glyphicon-folder-open"></span></a></li>
			<?php if( current_user_can('organico')) {  ?> 

				<?php 
					$user_id = get_current_user_id();
					$args = array(
							'type'=>'active',
							'per_page'=>1,
							'user_id'=>$user_id
					);
					if ( bp_has_groups($args) ) : 
					while ( bp_groups() ) : bp_the_group();
				?>
				<li><a href="<?php bp_group_permalink() ?>"><span class="glyphicon glyphicon-comment"></span></a></li> 
				<?php endwhile; ?>	

				<li><a href="<?php echo get_home_url(); ?>/blog"><span class="glyphicon glyphicon-heart"></span></a></li>
				<?php endif;?> 
			<?php } ?>
		</ul>
		<div class="barra-lateral">
			<?php if(is_page('actividad')): ?>
				<span class="selected">Muro</span>
			<?php elseif(is_page('info-basica')): ?>
				<span class="selected">Soy info basica</span>
				<ul>
					<li><a href="<?php echo get_home_url(); ?>/agenda">Agenda</a></li>
				</ul>
			<?php elseif(bp_is_page( BP_GROUPS_SLUG )): ?>
				<?php 
					$currentslug = bp_get_current_group_slug();
					$user_id = get_current_user_id();
					$args = array(
							'type'=>'active',
							'per_page'=>999,
							'user_id'=>$user_id
					);
					if ( bp_has_groups($args) ) : ?>
					<ul>
					<?php while ( bp_groups() ) : bp_the_group(); ?>
						<?php
							ob_start();
							bp_group_slug();
							$slugs = ob_get_contents();
							ob_end_clean();
						?>
						<li>
							<?php if($currentslug == $slugs){?>
								<span class="selected"><?php bp_group_name() ?></span>
							<?php }else{?>
								<a href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></a>
							<?php }?>

						</li>
					<?php endwhile; ?>	
					</ul>
				<?php endif;?>
			<?php endif;?>
			<div class="buscador">
				<form action="<?php echo bp_search_form_action(); ?>" method="post" id="search-form">
					<label for="search-terms" class="accessibly-hidden"><?php _e( 'Buscar:', 'buddypress' ); ?></label>
					<input type="text" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" />

					<?php echo bp_search_form_type_select(); ?>

					<input type="submit" name="search-submit" id="search-submit" value="<?php esc_attr_e( 'Buscar', 'buddypress' ); ?>" />

					<?php wp_nonce_field( 'bp_search_form' ); ?>

				</form><!-- #search-form -->
			</div>

		</div>
	</aside>
<?php endif;?>
<div id="page" class="container">

		<?php if(is_user_logged_in()):?>
		
			<div class="container">
				<?php 

				//wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav navbar-nav' ) ); ?>
			</div>
	<?php endif;?>

	<div id="content" class="site-content">
