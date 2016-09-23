<?php /* Template Name:Barrios */ 

get_header(); // This fxn gets the header.php file and renders it ?>


			<?php if ( have_posts() ) : 
			// Do we have any posts in the databse that match our query?
			?>

				<?php while ( have_posts() ) : the_post(); 
				// If we have a post to show, start a loop that will display it
				?>
	
				<div class="container">
						<div class="col-md-12 main-texto">
								<h1>
									<?php the_title(); ?>
								</h1>
								<?php the_content(); ?>
						</div>
				</div>
				
				<?php endwhile; // OK, let's stop the post loop once we've displayed it ?>
		
			<?php else : // Well, if there are no posts to display and loop through, let's apologize to the reader (also your 404 error) ?>
				
				<article class="post error">
					<h1 class="404">No hay nada</h1>
				</article>

			<?php endif; // OK, I think that takes care of both scenarios (having a post or not having a post to show) ?>
	<script type="text/javascript">
		window.pinsenproyecto = []
    			
	</script>
	<?php 

	$args = array( 'post_type' => 'barrios', 'posts_per_page' => -1 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); 

		$mapa = get_post_meta(get_the_ID(), '_pins_en_proyecto', true); 
	?>

		<script type="text/javascript">
				var pinsenmapa = "<?php echo $mapa; ?>";
				var jsonstr = pinsenmapa;
		        jsonstr = unescape(jsonstr);
		        var jsonData = JSON.parse(jsonstr);
		        $.each(jsonData,function(ind,val){
		        	val.title = "<?php the_title();?>";
		        	val.link = "<?php the_permalink();?>";
		        	 window.pinsenproyecto.push(val);
		        })
		       
		</script>
		
	<?php endwhile; // end of the loop. ?>
	<div id="mapagral">
		
	</div>
	<script type="text/javascript">
		console.log(pinsenproyecto);
    		var latlng = new google.maps.LatLng(-32.944243, -60.650539);
            var myOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var elem = $("#mapagral")[0];
            map = new google.maps.Map(elem, myOptions);
			var LatLngList = [];
            $.each(pinsenproyecto,function(ind,val){

            	var latitudLongitud = new google.maps.LatLng(val.lat, val.lng);
            	LatLngList.push(latitudLongitud)
            	var marker = new google.maps.Marker({
	                position: latitudLongitud, 
	                map: map
		        });
            	var container = '<div class="contenedor">';
            	container += '<h4><a href="'+val.link+'">'+val.title+'</a></h4>';
            	container += '<p>'+val.text+'</p>';
            	container += '</div>';

	            var infowindow = new google.maps.InfoWindow({
	                  content : container,
	                  maxWidth: 200
	                });
	            infowindow.open(map, marker);
	            google.maps.event.addListener(marker, "click", function() {
	             infowindow.open(map, marker);
	            });

	        })	
	</script>


<? get_footer() ?>