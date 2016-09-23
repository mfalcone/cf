

jQuery(document).ready(function($){

	// función para el tooltip de proyectos
	function simple_tooltip(target_items, name){
	 $(target_items).each(function(i){

	 	if($(this).attr('title')!=""){
			$("body").append("<div class='"+name+"' id='"+name+i+"'><p>"+$(this).attr('title')+"</p></div>");
			var my_tooltip = $("#"+name+i);

			$(this).removeAttr("title").mouseover(function(){
					my_tooltip.css({opacity:0.8, display:"none"}).fadeIn(400);
			}).mousemove(function(kmouse){
					my_tooltip.css({left:kmouse.pageX+15, top:kmouse.pageY+15});
			}).mouseout(function(){
					my_tooltip.fadeOut(400);
			});
			}
		});
	}

	 simple_tooltip("table a","tooltip");

	$(".equipo .glyphicon").click(function(){
		$(this).next().slideToggle();
	})

	$(".menulink .glyphicon").click(function(){
		$("#menu-menu-principal").slideToggle();
	})

	$(".tags .tag").click(function(e){
		$("tr").show();
		var slug = $(e.target).data("href");
		$("tr").each(function(ind,val){
			if(!$(val).is("."+slug)){
				console.log($(val))
				$(val).hide();
			}
		});
		if(!$(".tags #todos").size()){
			$(".tags").append('<span class="tag" id="todos">Mostrar todos</span>')
			$(".tags #todos").click(function(){
				$("tr").show();
				$(this).remove();
			})
		}
	})


	$("#contact_form li span").click(function(){

		$("#contact_form li span").not(this).attr("class","glyphicon glyphicon-unchecked")		

	
		if($(this).attr("class") == "glyphicon glyphicon-unchecked"){
			$(this).attr("class","glyphicon glyphicon-check");
			if($(this).parent().attr("id")=="otro"){
				console.log("mostrar")
				$("#otro_input").show();
			}
		}else{
			$(this).attr("class","glyphicon glyphicon-unchecked");
		}
	
	})


	$(".respuesta .desarrollo dt").click(function(){
		$span = $(this).find("span");
		if($span.attr("class") == "glyphicon glyphicon-chevron-down"){
			$span.attr("class","glyphicon glyphicon-chevron-up")
		}else{
			$span.attr("class","glyphicon glyphicon-chevron-down")
		}
		$(this).next().slideToggle();
	})

	window.aporte ="";

	$("#contact_form .dinero span").click(function(){
		aporte = $(this).data("check");
	})

	$("#otro_input").change(function(){
		aporte = $(this).val();
	})


	function validateEmail(email) 
	{
	    var re = /\S+@\S+\.\S+/;
	    return re.test(email);
	}



	$("#enviar").click(function(){
		var nombre = $('#nombre').val();
		if(nombre==""){
			alert("por favor ingrese su nombre")
			return;	
		}
		var domicilio = $('#direccion').val();
		var telefono = $('#telefono').val();
		var email = $('#mail').val();
		var dni = $('#dni').val();
		var cuil = $('#cuil').val();
		var localidad = $('#localidad').val();
		var codigo = $('#codigo').val();
		
		mailvalido = validateEmail(email);
		if(!mailvalido){
			alert("por favor ingreso una dirección de correo válida")
			return;
		}
		if(window.aporte==""){
			alert("por favor ingresá tu aporte");
			return;
		}
		var facebook = $('#facebook').val();
		var ocupacion = $("#ocupacion").val();
		var aporte = $("#aporte").val();

		var jason = {
			'nombre':nombre,
			'domicilio':domicilio,
			'dni':dni,
			'telefono':telefono,
			'email':email,
			'facebook':facebook,
			'cuil':cuil,
			'localidad':localidad,
			'codigo':codigo,
			'aporte':window.aporte
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

	$(".concejales .bt, .abrir-modal").click(function(){
		var $modal = $(this).next();
		$modal.wrap( "<div class='modal-wrap'></div>" );
		$modal.show();
		if(!$modal.find(".close").size()){
			$modal.append('<span class="close glyphicon glyphicon-remove"></span>');
			$modal.find(".close").click(function(e){
				$modal.hide();
				$modal.unwrap();
			})
		}
	})

	$(".vervotos").click(function(e){
			$(this).next().slideToggle();
	})


	if($("#mapa").size()){

		var map;
		window.pinsenproyecto = []
       
        var jsonstr = pinsenmapa;
        jsonstr = unescape(jsonstr);
        var jsonData = JSON.parse(jsonstr);
        window.pinsenproyecto = jsonData;
        

        //var latitudLongitud = new google.maps.LatLng($("#"+me.myid+" .latFld").val(), $("#"+me.myid+" .lngFld").val());
        /*counter = 0;
        placeMarker = function (location) {

            console.log(location)
            // first remove all markers if there are any
            //deleteOverlays();

            var marker = new google.maps.Marker({
                position: location, 
                map: map
            });
            counter++
           
            var pins = JSON.stringify(window.pinsenproyecto);
            pins = escape(pins);
            $("#_pins_en_proyecto").val(pins);
            // add marker in markers array
            markersArray.push(marker);
            marker.set("editing", false);
        
            //(4)Create a div element to display the HTML strings.
            var htmlBox = document.createElement("div");
            htmlBox.innerHTML =  "Editar contenido";
            htmlBox.style.width = "300px";
            htmlBox.style.height = "100px";
            
            //(5)Create a textarea for edit the HTML strings.
            var textBox = document.createElement("textarea");
            $(textBox).data("counter",counter);
            textBox.innerText = "";
            textBox.style.width = "300px";
            textBox.style.height = "100px";
            textBox.style.display = "none";
            
            //(6)Create a div element for container.
            var container = document.createElement("div");
            $(container).addClass("contenido");
            container.style.position = "relative";
            container.appendChild(htmlBox);
            container.appendChild(textBox);
            
            //(7)Create a button to switch the edit mode
            var editBtn = document.createElement("button");
            editBtn.innerText = "Editar";
            container.appendChild(editBtn);

            var borrarBtn = document.createElement("button");
            borrarBtn.innerText = "Borrar Marcador";
            container.appendChild(borrarBtn);
            
            var infowindow = new google.maps.InfoWindow({
                  content : container
                });

            google.maps.event.addListener(marker, "click", function() {
             infowindow.open(map, marker);
            });
            
            google.maps.event.addDomListener(editBtn, "click", function(e) {
                e.preventDefault();
                 marker.set("editing", !marker.editing);
            });

            google.maps.event.addDomListener(borrarBtn, "click", function(e) {
                e.preventDefault();
                $.each(window.pinsenproyecto,function(ind,val){
                    
                    if(val.lng == location.lng()){
                        window.pinsenproyecto.splice(ind,1)
                    }
                  })
                var pins = JSON.stringify(window.pinsenproyecto);
                pins = escape(pins);
              $("#_pins_en_proyecto").val(pins);
                marker.setMap(null);
                
            });

            google.maps.event.addListener(marker, "editing_changed", function(){
              textBox.style.display = this.editing ? "block" : "none";
              htmlBox.style.display = this.editing ? "none" : "block";
            });

            google.maps.event.addDomListener(textBox, "change", function(e){
              htmlBox.innerHTML = textBox.value;
              marker.set("html", textBox.value);
              var identificador = $(e.target).data("counter");
              //marcador.text=textBox.value;
              console.log(identificador);
              $.each(window.pinsenproyecto,function(ind,val){
                    if((identificador-1) == ind){
                        console.log("se da")
                        val.text = textBox.value;
                    }
              })
               var pins = JSON.stringify(window.pinsenproyecto);
              pins = escape(pins);
              $("#_pins_en_proyecto").val(pins);
             
            });

             infowindow.open(map, marker);
                //map.setCenter(location);
        }*/

       

        var geocoder = new google.maps.Geocoder();
       
        var latlng = new google.maps.LatLng(-32.944243, -60.650539);
            var myOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var elem = $("#mapa")[0];
            map = new google.maps.Map(elem, myOptions);
			var LatLngList = [];
            $.each(window.pinsenproyecto,function(ind,val){

            	var latitudLongitud = new google.maps.LatLng(val.lat, val.lng);
            	LatLngList.push(latitudLongitud)
            	var marker = new google.maps.Marker({
	                position: latitudLongitud, 
	                map: map
		        });

	            var infowindow = new google.maps.InfoWindow({
	                  content : val.text,
	                  maxWidth: 200
	                });
	            infowindow.open(map, marker);
	            google.maps.event.addListener(marker, "click", function() {
	             infowindow.open(map, marker);
	            });

	        })
            var bounds = new google.maps.LatLngBounds ();
			//  Go through each...
			for (var i = 0, LtLgLen = LatLngList.length; i < LtLgLen; i++) {
			  //  And increase the bounds to take this point
			  bounds.extend (LatLngList[i]);
			}
			map.fitBounds (bounds);
	        console.log(LatLngList);


    


	}

})