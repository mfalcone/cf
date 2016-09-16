
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

/*fin del admin de votaciones*/

	jQuery('#_proyecto, #_sesion').datepicker({
	        dateFormat : 'yy-mm-dd'
	    });

    jQuery('#_fecha_agenda, #_fecha_respuesta, #_fecha_votaciones').datepicker({
            dateFormat: 'yy-mm-dd'
        });
});