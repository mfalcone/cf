
	jQuery(document).ready(function($){
 
    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;
 
    // Runs when the image button is clicked.
    $('#meta-image-button').click(function(e){
 
        // Prevents the default action from occuring.
        e.preventDefault();
 
        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }
 
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: 'Selecciones imagen',
            button: { text:  'Seleccione D' },
            library: { type: 'application/pdf' }
        });
 
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
 
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
 			
            // Sends the attachment URL to our custom image input field.
            $('#_file').val(media_attachment.url);
        });
 
        // Opens the media library frame.
        meta_image_frame.open();
    });


$('#meta-image-button_persona').click(function(e){
 
        // Prevents the default action from occuring.
        e.preventDefault();
 
        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }
 
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: 'Selecciones imagen',
            button: { text:  'Seleccione Foto' },
            library: { type: 'image' }
        });
 
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
 
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            
            // Sends the attachment URL to our custom image input field.
            $('#_imagen').val(media_attachment.url);
        });
 
        // Opens the media library frame.
        meta_image_frame.open();
    });


$('#meta-image-button_concejal').click(function(e){
 
        // Prevents the default action from occuring.
        e.preventDefault();
 
        // If the frame already exists, re-open it.
        if ( meta_image_frame ) {
            meta_image_frame.open();
            return;
        }
 
        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: 'Selecciones imagen',
            button: { text:  'Seleccione Foto' },
            library: { type: 'image' }
        });
 
        // Runs when an image is selected.
        meta_image_frame.on('select', function(){
 
            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
            
            // Sends the attachment URL to our custom image input field.
            $('#_imagen_agrupacion').val(media_attachment.url);
            $("#wpt_agrupacion .inside").prepend('<img src="'+media_attachment.url+'"><br>')
        
        });
        // Opens the media library frame.
        meta_image_frame.open();
});

// votaciones

        
    $("table.concejales input").click(function(e){
        var valor = $(e.target).val();
        var valorTotal = $("#total"+valor).val();
        var $mytr = $(e.target).parents("tr");
        if($mytr.data('valor')){
            var valoranterior = $mytr.data('valor');
            var valorTotalAnterior = $("#total"+valoranterior).val();
            valorTotalAnterior--;
            $("#total"+valoranterior).val(valorTotalAnterior);
        }
        $mytr.data('valor',valor);
        var mijson={}
        mijson.img = $mytr.find("img").attr("src");
        mijson.nombre = $(e.target).attr("name");
        mijson.valor = $(e.target).attr("value");
        chekarsiExiste(mijson);
        valorTotal++;
        $("#total"+valor).val(valorTotal);
        
    })

// check if an element exists in array using a comparer function
// comparer : function(currentElement)
Array.prototype.inArray = function(comparer) { 
    for(var i=0; i < this.length; i++) { 
        if(comparer(this[i])) return true; 
    }
    return false; 
}; 

// adds an element to the array if it does not already exist using a comparer 
// function
Array.prototype.pushIfNotExist = function(element, comparer) { 
    if (!this.inArray(comparer)) {
        this.push(element);
    }
}; 

    function chekarsiExiste(mijson){
        tablaConcejales.pushIfNotExist(mijson, function(e) { 
            
            if(e.nombre==mijson.nombre){
                e.valor = mijson.valor;
            };
            return e.nombre === mijson.nombre 
        });

    var tbs = JSON.stringify(tablaConcejales);
    $("#concejales_totales").val(tbs)
    }

    if($("#concejales_votaciones").size()){

        if($("#concejales_totales").val()){


        var jsonstr = $("#concejales_totales").val();
        var jsonData = JSON.parse(jsonstr);
         window.tablaConcejales = jsonData;
        $.each(jsonData,function(ind,val){
            $(".concejales input[name="+val.nombre+"][value="+val.valor+"]").prop("checked", true);
            $(".concejales input[name="+val.nombre+"]").parents("tr").data("valor",val.valor)
        })

        }else{
            window.tablaConcejales = [];
        }

        $(window).scroll(function() {    
                var scroll = $(window).scrollTop();
                if (scroll >= 750) {
                    $(".concejales tr:eq(0)").addClass("tableheader");
                    $(".concejales tr:eq(0)").width($("#post-body-content").width())
                    $(".concejales tr:eq(0) th").width($("#post-body-content").width()/6)
                    $(".concejales tr:eq(0) th:eq(0)").width($("#post-body-content").width()/2)

                } else {
                    $(".concejales tr:eq(0)").removeClass("tableheader");
                }
        });
    }


 

    if($("#wpt_mapa").size()){

        var map;
        var markersArray=[];
        window.pinsenproyecto = []
       
        var jsonstr = $("#_pins_en_proyecto").val();
        if(jsonstr!=""){
            jsonstr = unescape(jsonstr);
            var jsonData = JSON.parse(jsonstr);
            window.pinsenproyecto = jsonData;
        }
        

        //var latitudLongitud = new google.maps.LatLng($("#"+me.myid+" .latFld").val(), $("#"+me.myid+" .lngFld").val());
        counter = 0;
        placeMarker = function (location,cont) {

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
            if(cont){
                var txt = cont;
            }else{
                var txt = "editar contenido"
            }
            htmlBox.innerHTML =  txt;
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
              editBtn.innerText =  this.editing ? "fin de edición" : "editar";
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
        }

       

        var geocoder = new google.maps.Geocoder();
       
        var latlng = new google.maps.LatLng(-32.944243, -60.650539);
            var myOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var elem = $("#mapa")[0];
            map = new google.maps.Map(elem, myOptions);

            google.maps.event.addListener(map, "click", function(event)
            {
                /*$("#"+me.myid+" .latFld").val(event.latLng.lat())
                $("#"+me.myid+" .lngFld").val(event.latLng.lng())
                me.codeLatLng();*/
                placeMarker(event.latLng);
                //console.log(event)
                 var marcador = {
                lng:event.latLng.lng(),
                lat:event.latLng.lat(),
                text:""
            }
            
           
            window.pinsenproyecto.push(marcador)

                //console.log(event.pixel)
               
            });
    
        if(jsonstr!=""){
             $.each(window.pinsenproyecto,function(ind,val){
                    //console.log(val)
                    var latitudLongitud = new google.maps.LatLng(val.lat, val.lng);
                    //console.log(latitudLongitud.lat());
                    //console.log(latitudLongitud.lng());
                    placeMarker(latitudLongitud,val.text);
                    
                   /* setTimeout(function(){
                        $("#mapa .contenido:eq("+ind+") div").html(val.text);
                        $("#mapa .contenido:eq("+ind+") textarea").text(val.text);
                       
                   },1500)*/
              })
            
        }

    }

/*fin del admin de votaciones*/

	jQuery('#_proyecto').datepicker({
	        dateFormat : 'yy-mm-dd'
	    });
    
    jQuery('#_sesion').datepicker({
            dateFormat : 'dd/mm/yy'
        });


    jQuery('#_fecha_agenda, #_fecha_respuesta, #_fecha_votaciones').datepicker({
            dateFormat: 'yy-mm-dd'
        });
});