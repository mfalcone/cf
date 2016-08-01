
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
 			console.log(media_attachment.url)
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
            console.log(media_attachment.url)
            // Sends the attachment URL to our custom image input field.
            $('#_imagen').val(media_attachment.url);
        });
 
        // Opens the media library frame.
        meta_image_frame.open();
    });

	jQuery('#_proyecto, #_sesion').datepicker({
	        dateFormat : 'dd/mm/yy'
	    });

    jQuery('#_fecha_agenda, #_fecha_respuesta').datepicker({
            dateFormat: 'yy-mm-dd'
        });
});