<?php

/**
 * Template Name: BuddyPress - Activity Directory
 *
 * @package BuddyPress
 * @subpackage Theme
 */

get_header( 'buddypress' ); ?>
	<?php 
	$userid= get_current_user_id();
  	$init = get_user_meta($userid,'init');
	//print_r($meta);
	//$init[0]="1";
	if($init[0]=="1"){
		$urlfinal = bp_core_get_user_domain($userid).'profile/edit/group/1/';?>

	<?php	
	}
	//muestra l
	//bp_profile_field_data('field=Domicilio&user_id='.$userid);
	?>
	<?php do_action( 'bp_before_directory_activity_page' ); ?>

	<div id="content">
		<div class="padder">

			<?php do_action( 'bp_before_directory_activity' ); ?>

			<?php if ( !is_user_logged_in() ) : ?>

				<h3><?php _e( 'Site Activity', 'buddypress' ); ?></h3>

			<?php endif; ?>

			<?php do_action( 'bp_before_directory_activity_content' ); ?>

			<?php if ( is_user_logged_in() ) : ?>

				<?php locate_template( array( 'activity/post-form.php'), true ); ?>

			<?php endif; ?>

			<?php do_action( 'template_notices' ); ?>
			<div class="actividad-wrapper">
				<div class="item-list-tabs activity-type-tabs" role="navigation">
					<ul>
						<?php do_action( 'bp_before_activity_type_tab_all' ); ?>

						<li class="selected" id="activity-all"><a href="<?php bp_activity_directory_permalink(); ?>" title="<?php esc_attr_e( 'The public activity for everyone on this site.', 'buddypress' ); ?>"><?php printf( __( 'Todos los miembros (<span>%s</span>)', 'buddypress' ), bp_get_total_member_count() ); ?></a></li>

						<?php if ( is_user_logged_in() ) : ?>

							<?php do_action( 'bp_before_activity_type_tab_friends' ); ?>

							<?php if ( bp_is_active( 'friends' ) ) : ?>

								<?php if ( bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

									<li id="activity-friends"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/'; ?>" title="<?php esc_attr_e( 'The activity of my friends only.', 'buddypress' ); ?>"><?php printf( __( 'mis amigos (<span>%s</span>)', 'buddypress' ), bp_get_total_friend_count( bp_loggedin_user_id() ) ); ?></a></li>

								<?php endif; ?>

							<?php endif; ?>

							<?php do_action( 'bp_before_activity_type_tab_groups' ); ?>

							<?php if ( bp_is_active( 'groups' ) ) : ?>

								<?php if ( bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>

									<li id="activity-groups"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_groups_slug() . '/'; ?>" title="<?php esc_attr_e( 'The activity of groups I am a member of.', 'buddypress' ); ?>"><?php printf( __( 'Mis grupos (<span>%s</span>)', 'buddypress' ), bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>

								<?php endif; ?>

							<?php endif; ?>

							<?php do_action( 'bp_before_activity_type_tab_favorites' ); ?>

							<?php if ( bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) : ?>

								<li id="activity-favorites"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/'; ?>" title="<?php esc_attr_e( "The activity I've marked as a favorite.", 'buddypress' ); ?>"><?php printf( __( 'My Favorites <span>%s</span>', 'buddypress' ), bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ); ?></a></li>

							<?php endif; ?>

							<?php if ( bp_activity_do_mentions() ) : ?>

								<?php do_action( 'bp_before_activity_type_tab_mentions' ); ?>

								<li id="activity-mentions"><a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/mentions/'; ?>" title="<?php esc_attr_e( 'Activity that I have been mentioned in.', 'buddypress' ); ?>"><?php _e( 'Menciones', 'buddypress' ); ?><?php if ( bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ) : ?> <strong><span><?php printf( _nx( '%s new', '%s new', bp_get_total_mention_count_for_user( bp_loggedin_user_id() ), 'Number of new activity mentions', 'buddypress' ), bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ); ?></span></strong><?php endif; ?></a></li>

							<?php endif; ?>

						<?php endif; ?>

						<?php do_action( 'bp_activity_type_tabs' ); ?>
					</ul>
				</div><!-- .item-list-tabs -->

				<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
					<ul>
						
						<li id="activity-filter-select" class="last">
							<label for="activity-filter-by"><?php _e( 'Mostrar:', 'buddypress' ); ?></label>
							<select id="activity-filter-by">
								<option value="-1"><?php _e( '&mdash; Todo &mdash;', 'buddypress' ); ?></option>
								<option value="activity_update"><?php _e( 'actualizaciones', 'buddypress' ); ?></option>

								<?php if ( bp_is_active( 'blogs' ) ) : ?>

									<option value="new_blog_post"><?php _e( 'Posts', 'buddypress' ); ?></option>
									<option value="new_blog_comment"><?php _e( 'Comments', 'buddypress' ); ?></option>

								<?php endif; ?>

								<?php if ( bp_is_active( 'forums' ) ) : ?>

									<option value="new_forum_topic"><?php _e( 'Forum Topics', 'buddypress' ); ?></option>
									<option value="new_forum_post"><?php _e( 'Forum Replies', 'buddypress' ); ?></option>

								<?php endif; ?>

								<?php if ( bp_is_active( 'groups' ) ) : ?>

									<option value="created_group"><?php _e( 'New Groups', 'buddypress' ); ?></option>
									<option value="joined_group"><?php _e( 'Group Memberships', 'buddypress' ); ?></option>

								<?php endif; ?>

								<?php if ( bp_is_active( 'friends' ) ) : ?>

									<option value="friendship_accepted,friendship_created"><?php _e( 'Friendships', 'buddypress' ); ?></option>

								<?php endif; ?>

								<option value="new_member"><?php _e( 'New Members', 'buddypress' ); ?></option>

								<?php do_action( 'bp_activity_filter_options' ); ?>

							</select>
						</li>
					</ul>
				</div><!-- .item-list-tabs -->
			</div>
			<?php do_action( 'bp_before_directory_activity_list' ); ?>

			<div class="activity" role="main">

				<?php locate_template( array( 'activity/activity-loop.php' ), true ); ?>

			</div><!-- .activity -->

			<?php do_action( 'bp_after_directory_activity_list' ); ?>

			<?php do_action( 'bp_directory_activity_content' ); ?>

			<?php do_action( 'bp_after_directory_activity_content' ); ?>

			<?php do_action( 'bp_after_directory_activity' ); ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php do_action( 'bp_after_directory_activity_page' ); ?>
<?php
	if($init[0]=="1"){?>
		<link href="<?php echo get_template_directory_uri();?>/_inc/css/bootstrap-tour-standalone.min.css" rel="stylesheet">
		<script src="<?php echo get_template_directory_uri();?>/js/bootstrap-tour-standalone.min.js"></script>
		<script type="text/javascript" charset="utf-8">
		function mobile() {
		   if(window.innerWidth <= 800 && window.innerHeight <= 600) {
		     return true;
		   } else {
		     return false;
		   }
		};

		$(function() {
		  if (mobile()) {
		    return;
		  }
		  var tour = new Tour({
		    template: ' <div class="popover tour"> <div class="arrow"></div> <h3 class="popover-title"></h3> <div class="popover-content"></div> <div class="popover-navigation"> <button class="btn btn-default" data-role="prev">«</button> <span data-role="separator"></span> <button class="btn btn-default" data-role="next">»</button> &nbsp;&nbsp;<button class="btn btn-default" data-role="end">Fin</button> </div> </div>',
		    steps: [
		    {
		      title: "<h4>Si no lo hacemos entre todos, no lo hace nadie</h4>",
		      content: "<p>El portal Hagamos es una herramienta más que creamos para que todas y todos puedan sumar su voz, opinar y participar.</p>  <p>Estés donde estés, tengas el tiempo que tengas, en Ciudad Futura todos tienen su lugar.</p> <p>El poder de la gente común crece si todos nos involucramos, por eso te necesitamos.</p> ",
		      orphan: true,
		    },
		    {
		      element: ".quiero",
		      title: "<h4>QUIERO</h4>",
		      content: "<p>En el menú QUIERO, te proponemos algunas maneras en las que podés participar de la construcción de CIUDAD FUTURA</p> <p>Desde conocer en persona nuestros proyectos prefigurativos hasta sumar tu aporte económico. En cada una de las opciones, vas a encontrar información detallada.</p>",
		      onShow: function() {
		        $('.quiero h3').click();
		      },
		      backdrop: false
		    },
		    {
		      element: ".hacer",
		      title: "<h4>HACER</h4>",
		      content: "<p>Si ya sos militante de CIUDAD FUTURA, en este menú vas a encontrar tus grupos de trabajo y material de formación.</p>",
		      onShow: function() {
		        $('.hacer h3').click();
		      },
		      backdrop: false

		    },
		    {
		      element: "#activity-stream",
		      title: "<h4>Este es tu muro</h4>",
		      content: "<p>HAGAMOS es el lugar donde nos encontramos con otras personas que quieren trabajar en una realidad mejor</p><p>Acá vas a ver la actividad del resto de las personas</p><p>Debatí con tus vecinos, buscá un tema en el que puedas aportar lo que sabes hacer!</p>",
		    },
		    {
		      element: ".actividad-wrapper",
		      title: "<h4>Demasiada información?</h4>",
		      content: "Acá podés filtrar los contenidos que aparece en tu pantalla.",
		      backdropPadding: 20,
		    },
		    {
		      element: "#whats-new-form",
		      title: "<h4>Lo más importante</h4>",
		      content: "<p>HAGAMOS se creó para potenciar la voz de la gente común.</p><p>Compartí tus ideas y proyectos, contá lo que pasa en tu barrio.</p> ",
		    },
		    {
		      element: "ul.agenda",
		      title: "<h4>Contenido destacado</h4>",
		      content: "<p>En esta sección vas a ver algunos eventos destacados, podés sumar el tuyo a la agenda.</p> <p>También te proponemos alunos debates e ideas de otros usuarios para que aportes tu opinión.</p>",
		      placement: "left",
		      backdrop: false
		    },
		    {
		      orphan: true,
		      title: "<h4>Listo!</h4>",
		      content: "<p>Nos gustaría conocerte un poco más, en esta pantalla, podés agregar una foto de perfil, y responder algunas preguntas sobre tu relación con CIUDAD FUTURA.</p> <p>Gracias por sumarte!</p>",
		      path: "<?php echo $urlfinal; ?>"
		    }
		    ],
		    backdrop: true,
		    onEnd: function(tour) {
		      if (tour.getCurrentStep() !== 7) {
		        window.location = "<?php echo $urlfinal; ?>"
		      }
		    },
		    storage:false
		  });

		  tour.init();
		  tour.start(true);
		});
		</script>
	<?php	
	}
	?>
<?php get_footer( 'buddypress' ); ?>
