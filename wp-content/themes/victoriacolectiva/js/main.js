$(document).ready(function(){


	$('a[href^="http://"]').not('a[href*=hagamos]').attr('target','_blank');

	$(".bt .escribir").click(function(){
		$(".editor").slideToggle();
	})

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

	$("#search-terms").focus(function(){
		$(".propiedaes").fadeIn();
	})

	$("#search-terms").blur(function(){
		//$(".propiedaes").fadeOut();
	})

	$("#right-sidebar .pestania").click(function(){
		$("#right-sidebar").toggleClass("open");
		$("#colophon").toggleClass("open");
		$("#content").toggleClass("right-side-opens");
	})

	if($("body").hasClass("activity")){
		$('.show').stop(true, true).delay(1500).animate({height:'80px'}, 500);
		$('#page').stop(true, true).delay(1500).animate({top:'75px'}, 500);
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

	if($(".quiero .selected").size()==1){
		$(".quiero h3").trigger("click");
	}else if($(".hacer .selected").size()==1){
		$(".hacer h3").trigger("click");
	}
	

	$("#whats-new-form textarea").on("input",function(){
		$(this).height("82px").height($(this)[0].scrollHeight);
	})

	$("#activity-stream textarea").on("input",function(){
		$(this).height("15px").height($(this)[0].scrollHeight);
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
				var lat = place.geometry.location.lat();
				var lng = place.geometry.location.lng();
				
				$(".geolocalizacion").find("input").val("lat:"+lat+"/lng:"+lng)
				 

			});
			map.fitBounds(bounds);
		  });
		  // [END region_getplaces]
		}

		/*google map de quiero hacer un mapeo*/

	   if($("#quiero-mapeo").size()){
		var latlng = new google.maps.LatLng(-32.944243, -60.650539);
			 var myOptions = {
				zoom: 13,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var elem = $("#quiero-mapeo")[0];
			map = new google.maps.Map(elem, myOptions);
			
			var input = document.getElementById("direccion");
			var searchBox = new google.maps.places.SearchBox(input);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
			map.addListener('bounds_changed', function() {
				searchBox.setBounds(map.getBounds());
			  });


			google.maps.event.addDomListener(input, 'keydown', function(e) { 
				if (e.keyCode == 13) { 
					e.preventDefault(); 
					}
			})

			google.maps.event.addListener(map, 'click', function(event) {
			   placeMarker(event.latLng);
			});

			var marker;
			function placeMarker(location) {
				if (marker)
					marker.setMap(null);
				 	markers.forEach(function(marker) {
					marker.setMap(null);
				});
				markers = [];

				marker = new google.maps.Marker({
					position: location, 
					map: map
				});

				var geocoder= new google.maps.Geocoder();
				var latlng = new google.maps.LatLng(location.lat(), location.lng());
				console.log(latlng)
				$("#lat").val(location.lat());
				$("#lng").val(location.lng());
				geocoder.geocode({
				'latLng': latlng
			  }, function (results, status) {
				if (status === google.maps.GeocoderStatus.OK) {
				  if (results[1]) {
					$("#direccion").val(results[1].formatted_address);
				  } else {
					alert('No results found');
				  }
				} else {
				  alert('Geocoder failed due to: ' + status);
				}
			  });
			}

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
				if (marker)
				marker.setMap(null);
				markers.forEach(function(marker) {
				  marker.setMap(null);
				});
				markers = [];

				// For each place, get the icon, name and location.
				var bounds = new google.maps.LatLngBounds();
				places.forEach(function(place) {
				  	// Create a marker for each place.
				  	markers.push(new google.maps.Marker({
						map: map,
						title: place.name,
						position: place.geometry.location
					  }));

					if (place.geometry.viewport) {
						// Only geocodes have viewport.
						bounds.union(place.geometry.viewport);
					} else {
						bounds.extend(place.geometry.location);
					}
					var lat = place.geometry.location.lat();
					var lng = place.geometry.location.lng();
					
					$("#lat").val(lat);
					$("#lng").val(lng);
				});
				map.fitBounds(bounds);
			});
		  	// [END region_getplaces]
		}//fin del quiero mapeo
	   
	   // notificaciones
	   $("#bp-nav-menu-notifications-default .number").click(function(){
			if($(".notification-wrapper").size()){
				$(".notification-wrapper").remove();
			}else{
				$notifwrapper = $('<div class="notification-wrapper"></div>');
				var contenido = $("#bp-nav-menu-notifications-default ul").clone();
				console.log(contenido.html())
				if(contenido.html()==undefined){
					contenido = "<p>no hay notificaciones"
				}
				$("body").append($notifwrapper);
				$(".notification-wrapper").html(contenido);
				$(".notification-wrapper").fadeIn('slow');
			}
	   })

	   //mostrar el sidebar en ancho menor a 1000 px.
	   $(".menu-toggle").click(function(){
			$("#sidebar").toggleClass("open");
	   })

	   $(".acomment-reply").click(function(e){
			e.preventDefault();
				})

	   $("#fecha_inicio, #fecha_fin").datepicker({
			 dateFormat: "yy-mm-dd"
	   });

	   $(".field_por-que-te-sumaste-a-hagamos-ciudadfutura-com-ar input[type='checkbox']:last").click(function(){

			$(".field_seccionales, .field_proyectos-estrategicos, .field_equipo-concejo").show();
	   
	   })

	   if($(".field_por-que-te-sumaste-a-hagamos-ciudadfutura-com-ar input[type='checkbox']:last").prop('checked')){
			$(".field_seccionales, .field_proyectos-estrategicos, .field_equipo-concejo").show();
	   }

	/*aportes*/

	window.aporte ="";
	window.tipocuenta="";
	window.cuenta="";

   $("#contact_form .dinero li span").click(function(){

		$("#contact_form .dinero li span").not(this).attr("class","glyphicon empty-circle")		
		aporte = $(this).data("check");
		if($(this).attr("class") == "glyphicon empty-circle"){
			$(this).attr("class","glyphicon glyphicon-ok-circle");
			if($(this).parent().attr("id")=="otro"){
				$("#otro_input").show();
			}
		}else{
			$(this).attr("class","glyphicon empty-circle");
		}

	})

	$("#otro_input").change(function(){
		aporte = $(this).val();
	})
	
	$("#contact_form .tipocuenta span").click(function(){
		$("#contact_form .tipocuenta li span").not(this).attr("class","glyphicon empty-circle")		
		if($(this).attr("class") == "glyphicon empty-circle"){
			$(this).attr("class","glyphicon glyphicon-ok-circle");
			}else{
			$(this).attr("class","glyphicon empty-circle");
		}
		tipocuenta = $(this).data("check");
	})

	
	$("#contact_form .cuenta span").click(function(){
		$("#contact_form .cuenta li span").not(this).attr("class","glyphicon empty-circle")		
		if($(this).attr("class") == "glyphicon empty-circle"){
			$(this).attr("class","glyphicon glyphicon-ok-circle");
			}else{
			$(this).attr("class","glyphicon empty-circle");
		}
		cuenta = $(this).data("check");
	})

	$("#enviar").click(function(){
		var nombre = $('#nombre').val();
		var cbu = $('#cbu').val();
		var numero = $('#numero').val();

		if(nombre==""){
			alert("por favor ingrese su nombre")
			return;	
		}

		if(cbu==""){
			alert("por favor ingrese el CBU")
			return;	
		}

		if(numero==""){
			alert("por favor ingrese el numero de cuenta")
			return;	
		}
		
		if(tipocuenta==""){
			alert("por favor seleccioná el tipo de cuenta")
			return;	
		}

		if(cuenta==""){
			alert("por favor seleccioná el tipo de cuenta")
			return;	
		}

		
		
		if(window.aporte==""){
			alert("por favor ingresá tu aporte");
			return;
		}

		if($("#otro_input").is(":visible")){
			var aporte = $("#aporte").val();
		}

		var jason = {
			'nombre':nombre,
			'cbu':cbu,
			'tipocuenta':window.tipocuenta,
			'cuenta':window.cuenta,
			'dinero':window.aporte,
			'numerocuenta':numero
		}
		console.log(jason)
		$.ajax({
			type: "POST",
			cache: false,
			url: $("#contact_form").data("form")+"/aporte.php",
			data: "data="+JSON.stringify(jason),
			success: function(data) {
				alert(data);
			}
		});
	})
	/*cookies que están generando quilombo*/
	delete_cookie = function(name) {
		document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
	};

	$("li.muro a").click(function(){
		delete_cookie("bp-activity-oldestpage")
		delete_cookie("bp-activity-scope")
		delete_cookie("bp-activity-filter")
	})
	/*para que se abran todos los links en ventanas externas*/
	

	/*prefiero que me llamen*/
	$("#prefiero_que_me_llamen").click(function(){

		var jason2 = {
			'nombre':username,
			'telefono':telefono
		}
		if(telefono==""){
			alert("No tenemos tu teléfono, por favor, editá tu perfil e ingresalo");
			return;	
		}

		console.log(jason2)
		$.ajax({
			type: "POST",
			cache: false,
			url: $("#contact_form").data("form")+"/aporte.php",
			data: "llamar="+JSON.stringify(jason2),
			success: function(data) {
				alert(data);
			}
		});
	})

var wysihtml5ParserRules = {
  tags: {
    strong: {},
    b:      {},
    i:      {},
    em:     {},
    br:     {},
    p:      {},
    div:    {},
    span:   {},
    ul:     {},
    ol:     {},
    li:     {},
    a:      {
      set_attributes: {
        target: "_blank",
        rel:    "nofollow"
      },
      check_attributes: {
        href:   "url" // important to avoid XSS
      }
    }
  }
};

if($(".page-template-page-blog").size() || $(".page-template-template-edit-foto").size()){
	var editor = new wysihtml5.Editor("postContent", {
    toolbar:      "toolbar",
    parserRules:  wysihtml5ParserRules
  });	
}

})

/**
 * Very simple basic rule set
 *
 * Allows
 *    <i>, <em>, <b>, <strong>, <p>, <div>, <a href="http://foo"></a>, <br>, <span>, <ol>, <ul>, <li>
 *
 * For a proper documentation of the format check advanced.js
 */
