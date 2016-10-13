$(document).ready(function(){



	$(".bt .escribir").click(function(){
		$(".editor").slideToggle();
	})

function InOut( elem )
{
 elem.delay()
     .fadeIn()
     .delay(2200)
     .fadeOut( 
               function(){ 
                   if(elem.next().length > 0)
                   {InOut( elem.next() );}
                   else
                   {InOut( elem.siblings(':first'));}
                         
                 }
             );
}

	$('.ahora li').hide();
	InOut( $('.ahora li:first') );

	$("#search-terms").focus(function(){
		$(".propiedaes").fadeIn();
	})

	$("#search-terms").blur(function(){
		$(".propiedaes").fadeOut();
	})

	$("#right-sidebar .pestania").click(function(){
		$("#right-sidebar").toggleClass("open");
		$("#colophon").toggleClass("open");
		$("#content").toggleClass("right-side-opens");
	})

	if($("body").hasClass("activity")){
	 	$('.show').stop(true, true).delay(1500).animate({height:'80px'}, 500);
	 	$('#content').stop(true, true).delay(1500).animate({top:'60px'}, 500);
	 	$('#right-sidebar').stop(true, true).delay(1500).animate({top:'80px'}, 500);
	}

	function ocultarSlidesSidebar(){
		$(".quiero ul, .hacer ul").removeClass("active");
		$(".quiero ul, .hacer ul").slideUp(300);
	}
	$(".quiero h3, .hacer h3").click(function(){
		if($(this).next('ul').is(".active")){
			ocultarSlidesSidebar();
		}else{
			ocultarSlidesSidebar();
			$(this).next('ul').addClass("active");
			$(this).next('ul').slideDown(300);
		}
	})
	if($("body").is(".groups") || $("body").is(".page-template-page-blog") ||  $("body").is(".page-template-page-agenda-php") ){
		$(".hacer h3").trigger("click");
	}

	$("#whats-new-form textarea").on("input",function(){
		$(this).height("82px").height($(this)[0].scrollHeight);
	})

	if($("body").hasClass("registration")){
			var latlng = new google.maps.LatLng(-32.944243, -60.650539);
            var myOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var elem = $("#domicilio")[0];
            map = new google.maps.Map(elem, myOptions);
        	console.log(google);
        	inputid = $("#domicilio").prev().find("input").attr("id");

        	var input = document.getElementById(inputid);
			var searchBox = new google.maps.places.SearchBox(input);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
			$(inputid).addClass("domicilio");
			map.addListener('bounds_changed', function() {
			    searchBox.setBounds(map.getBounds());
			  });


			google.maps.event.addDomListener(input, 'keydown', function(e) { 
			    if (e.keyCode == 13) { 
			        e.preventDefault(); 
			    	}
		    })

			 var markers = [];
		  // [START region_getplaces]
		  // Listen for the event fired when the user selects a prediction and retrieve
		  // more details for that place.
		  searchBox.addListener('places_changed', function() {
		    var places = searchBox.getPlaces();

		    if (places.length == 0) {
		      return;
		    }

		    // Clear out the old markers.
		    markers.forEach(function(marker) {
		      marker.setMap(null);
		    });
		    markers = [];

		    // For each place, get the icon, name and location.
		    var bounds = new google.maps.LatLngBounds();
		    places.forEach(function(place) {
		      var icon = {
		        url: place.icon,
		        size: new google.maps.Size(71, 71),
		        origin: new google.maps.Point(0, 0),
		        anchor: new google.maps.Point(17, 34),
		        scaledSize: new google.maps.Size(25, 25)
		      };

		      // Create a marker for each place.
		      markers.push(new google.maps.Marker({
		        map: map,
		        icon: icon,
		        title: place.name,
		        position: place.geometry.location
		      }));

		      if (place.geometry.viewport) {
		        // Only geocodes have viewport.
		        bounds.union(place.geometry.viewport);
		      } else {
		        bounds.extend(place.geometry.location);
		      }
		    });
		    map.fitBounds(bounds);
		  });
		  // [END region_getplaces]


        }
})