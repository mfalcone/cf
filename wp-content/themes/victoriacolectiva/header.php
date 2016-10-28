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
		<div class="menu-toggle">
			<span class="glyphicon glyphicon-align-justify"></span>	
		</div>
		<div class="cf-icon">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Hagamos</a>
		</div><!-- .site-branding -->
		<div class="header-container">
			<div class="buscador">
				<form action="<?php echo bp_search_form_action(); ?>" method="post" id="search-form">
					
					<input type="text" placeholder="buscar" id="search-terms" name="search-terms" value="<?php echo isset( $_REQUEST['s'] ) ? esc_attr( $_REQUEST['s'] ) : ''; ?>" />
					
					<div class="propiedaes">
						<?php //echo bp_search_form_type_select(); ?>
						<label for="search-which" class="accessibly-hidden">Filtrar por:</label>
						<select name="search-which" id="search-which" style="width: auto">
							<option value="members">Miembros</option>
							<option value="groups">Grupos</option>
						</select>
						<input type="submit" name="search-submit" id="search-submit" value="<?php esc_attr_e( 'Buscar', 'buddypress' ); ?>" />
					</div>
					

					<?php wp_nonce_field( 'bp_search_form' ); ?>

				</form><!-- #search-form -->
			</div>
			
		</div>
		
		<div class="user">
			<div id="bp-nav-menu-notifications-default" class="bp-nav-menu-submenu">
                            <?php
                                $notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id(), 'object' );
                                $count         = ! empty( $notifications ) ? count( $notifications ) : 0;
                                $alert_class   = (int) $count > 0 ? 'pending-count alert' : 'count no-alert';
                                $menu_title    = '<span id="ab-pending-notifications" class="' . $alert_class . '">' . number_format_i18n( $count ) . '</span>';
                                $menu_link     = trailingslashit( bp_loggedin_user_domain() . bp_get_notifications_slug() );
                                if ( ! empty( $notifications ) ) {
                                	?>
                                	<span class="number"><?php echo number_format_i18n( $count ); ?></span>
                                	<ul><?php
                                    foreach ( (array) $notifications as $notification ) {
                                        ?>
                                        <li id="bp-nav-menu-notification-<?php echo $notification->id; ?>" class="algo">
                                            <a class="bp-nav-menu-item" href="<?php echo $notification->href; ?>">
                                                <?php echo $notification->content; ?>
                                            </a>
                                        </li>
                                        <?php
                                    }?>
                                   </ul> 
                                <?php } else {
                                    ?>
                                    <span class="number">
                                            0
                                    </span>
                                    <?php
                                }
                            ?>
            </div>
			<a href="<?php echo bp_loggedin_user_domain(); ?>">
				<?php 
					global $current_user;
					$username = $current_user->user_login;
					echo $username;
				?>
				<?php bp_loggedin_user_avatar( 'width=' . bp_core_avatar_thumb_width() . '&height=' . bp_core_avatar_thumb_height() ); ?></a>
			<a href="<?php echo wp_logout_url(home_url()); ?>">Salir <span class="glyphicon glyphicon-off"></span></a>
		</div>
	</header><!-- #masthead -->
	<?php if(is_user_logged_in()):?>
	<aside id="sidebar">
		<ul id="main-menu">
			<li class="muro"><h3><a href="<?php echo get_home_url(); ?>/actividad"><span class="glyphicon glyphicon-comment"></span>MURO</a></h3></li>
			<li class="quiero"><h3><span class="glyphicon glyphicon-heart"></span>Quiero</h3>
				<?php wp_nav_menu( array( 'theme_location' => 'quiero-menu','container' => '' ) ); ?>
			</li>
			<li class="hacer"><h3><span class="glyphicon glyphicon-forward"></span>Hacer</h3>

				<ul>
						<?php 
						$currentslug = bp_get_current_group_slug();
						$user_id = get_current_user_id();
						$args = array(
								'type'=>'active',
								'per_page'=>3,
								'user_id'=>$user_id
						);
						if ( bp_has_groups($args) ) : ?>
						<?php while ( bp_groups() ) : bp_the_group(s); ?>
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
						<?php endif;?>
						
						<?php wp_nav_menu( array( 'theme_location' => 'hacer-menu','container' => '','items_wrap' => '%3$s') ); ?>
				</ul>		
			</li>
		</ul>
	</aside>
	<div class="show">
			<div class="ahora">
				<h2>#Ahora en Ciudad Futura:</h2>
				<ul>
						<?php 
						$args = array('post_type' => 'ahora','posts_per_page' => -1);
						$loop = new WP_Query( $args );
						//print_r($loop);
						while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<li><?php the_title();?></li>
						<?php endwhile; ?>
				</ul>
			</div>
		</div>
<?php endif;?>
<div id="page" class="container">

		<?php if(is_user_logged_in()):?>
		
			<div class="container">
				<?php 

				//wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_class' => 'nav navbar-nav' ) ); ?>
			</div>
	<?php endif;?>

	<div id="content" class="site-content right-side-opens">
	