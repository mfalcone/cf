<?php 
add_action( 'widgets_init', 'ahora_widget_init' );
 
function ahora_widget_init() {
    register_widget( 'ahora_ciudad_futura' );
}
 
class ahora_ciudad_futura extends WP_Widget
{
 
    public function __construct()
    {
        $widget_details = array(
            'classname' => 'ahora_ciudad_futura',
            'description' => 'Slider de lo que pasa ahora en Ciudad Futura'
        );
 
        parent::__construct( 'ahora_ciudad_futura', 'Ahora en Ciudad Futura', $widget_details );
 
    }
 
    public function form( $instance ) {
        // Backend Form
    }
 
    public function update( $new_instance, $old_instance ) {  
        return $new_instance;
    }
 
    public function widget( $args, $instance ) {?>
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
            <script type="text/javascript">
                function InOut( elem ){
                     elem.delay()
                         .fadeIn()
                         .delay(2200)
                         .fadeOut( 
                                   function(){ 
                                       if(elem.next().length > 1)
                                       {InOut( elem.next() );}
                                       else
                                       {InOut( elem.siblings(':first'));}
                                             
                                     }
                                 );
                    }

                    $('.ahora li').hide();
                    InOut( $('.ahora li:first') );
            </script>
    <?php }
 
}