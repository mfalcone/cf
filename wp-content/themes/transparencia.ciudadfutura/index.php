<? get_header() ?>
		<div class="container">
			<div class="col-md-12 main-texto">
					<h1>
								<?php echo get_bloginfo( 'description'); ?>
					</h1>
					<?php echo get_option( 'desc_general', '' ); ?>

			</div>

		</div>
 <style type="text/css">
	
		.slice path {
		  stroke: #fff;
		}
</style>

<section class="container">
	
	<?php 

	$args = array( 'post_type' => 'movimientos', 'posts_per_page' => 4 );
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post(); ?>

		<div class="graph-group col-md-12 nomarginpadding">
			<h2><?php the_title(); ?></h2>
			<div id="chart<?php echo get_the_ID(); ?>" class="col-md-6 chart"></div>
			<div id="data-<?php echo get_the_ID(); ?>" class="col-md-6 chart"></div>

			<?php

			$meta = get_post_meta( get_the_ID() ); 

			foreach( $meta as $key => $value ) {
				$exp_key = explode('_', $key);
				if($exp_key[0] == 'data'){
			         
			         $arr_result[$key] =  $value[0];
			         $arr_exclude[] = $key;
			         
			    }
			}
			$exclude = array('_edit_last', '_wp_page_template', '_edit_lock');
			$exclude = array_merge($exclude,$arr_exclude);
			
			//print_r($arr_result);
			
			?>
			<script type="text/javascript">

				if(jQuery(window).width()>450){
					var w = 450;
					var h = 450;
					var r = 220;	
				}else{
					var w = 310;
					var h = 310;
					var r = 130;
				}

				
					color = ["#C31F24", "#DE5A48", "#EEC94B", "#45B29D", "#344D5C", "#B2181C", "#E2493D","#3A9E8A","#375D70"];//d3.scale.category20c();     //builtin range of colors
					data = [
			<?php foreach( $meta as $key => $value ) {
				if( in_array( $key, $exclude) )
				    continue;
				?>
				{"label":"<?php echo $key; ?>", "value":<?php echo $value[0]; ?>}, 
			<?php
			}
			?>
			];
			 data_desc = [
			<?php 
			foreach ($arr_result as $clave=>$valor){?>
				{"etiqueta":"<?php echo $clave; ?>", "valor":"<?php echo $valor; ?>"}, 
			<?php
			}
			?>
			];



					var vis = d3.select("#chart<?php echo get_the_ID(); ?>")
						.append("svg:svg")              //create the SVG element inside the <body>
						.data([data])                   //associate our data with the document
							.attr("width", w)           //set the width and height of our visualization (these will be attributes of the <svg> tag
							.attr("height", h)
						.append("svg:g")                //make a group to hold our pie chart
							.attr("transform", "translate(" + r + "," + r + ")")    //move the center of the pie chart from 0, 0 to radius, radius
					var arc = d3.svg.arc()              //this will create <path> elements for us using arc data
						.outerRadius(r)
						.innerRadius(r-100);
					var pie = d3.layout.pie()           //this will create arc data for us given a list of values
						.value(function(d) { return d.value; });    //we must tell it out to access the value of each element in our data array
					var arcs = vis.selectAll("g.slice")     //this selects all <g> elements with class slice (there aren't any yet)
						.data(pie)                          //associate the generated pie data (an array of arcs, each having startAngle, endAngle and value properties) 
						.enter()                            //this will create <g> elements for every "extra" data element that should be associated with a selection. The result is creating a <g> for every object in the data array
							.append("svg:g")                //create a group to hold each slice (we will have a <path> and a <text> element associated with each slice)
								.attr("class", "slice");    //allow us to style things in the slices (like text)
						arcs.append("svg:path")
								.attr("fill", function(d, i) { return color[i]; } ) //set the color for each slice to be chosen from the color function defined above
								.attr("d", arc);                                    //this creates the actual SVG path using the associated data (pie) with the arc drawing function
						arcs.append("svg:text")                                     //add a label to each slice
								.attr("transform", function(d) {                    //set the label's origin to the center of the arc
								//we have to make sure to set these before calling arc.centroid
								d.innerRadius = 0;
								d.outerRadius = r;
								return "translate(" + arc.centroid(d) + ")";        //this gives us a pair of coordinates like [50, 50]
							})
							.attr("text-anchor", "middle")                          //center the text on it's origin
							.text(function(d, i) { 
							return data[i].value+"%"; 

							});        //get the label from our original data array
						
						$("#data-<?php echo get_the_ID(); ?>").html("<ul>");
						$.each(data,function(ind,val){
								
							var $li=$('<li></li>');
							$li.html('<h3>'+data[ind].value+'%</h3><p>'+data[ind].label+'</p>');
							$.each(data_desc,function(indice,val){
								var etiqueta = val.etiqueta.replace("data_","");
								if(data[ind].label == etiqueta){
									$li.append('<p class="desc">'+val.valor+'</p>');
								}
							})
							
							$li.find("h3").css("color",color[ind])
							$("#data-<?php echo get_the_ID(); ?> ul").append($li);
						
						})

					</script>
		</div>

	<?php endwhile; // end of the loop. ?>
</section>


<? get_footer() ?>
