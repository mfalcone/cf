jQuery(document).ready(function(){
jQuery(".admin-control span").click(function(e){
	$(this).next().toggle();
})

jQuery(".admin-control #enviar-contenido").click(function(e){	
	
 	
    $li = jQuery(this).parents('li');
    user_id = $li.data('userid');
    var usuario = $li.find(".activity-header p a:eq(0)").text();
    var link = $li.find(".activity-header .activity-time-since").attr("href");
    var content = $li.find(".activity-inner").html();
    var posttitle = $li.find("input#titulo").val();
    var justificacion = $li.find("textarea#justificacion").val();
    var img = $li.find("img").attr("src");
    var autor = usuario;
    var vinculo = link;
    var postcontent = content;
    $li.find(".data-al-user").text("cargando...")
           
    jQuery.ajax({
 
        type: 'POST',
 
        url: apfajax.ajaxurl,
 	  data: {
            action: 'apf_addpost',
            apftitle: posttitle,
            apfcontents: postcontent,
            autor: autor,
            vinculo: vinculo,
            justificacion: justificacion,
            user_id:user_id,
            img:img
        },
 
        success: function(infodata, textStatus, XMLHttpRequest) {
           infodata = JSON.parse(infodata);
           $li.find(".data-al-user").text("se ha creado la publicación, enviando email a: "+infodata.mail)
           data = {
			    action: 'mail_before_submit',
			    toemail: infodata.mail, // change this to the email field on your form
			    subject: infodata.subject, // change this to the email field on your form
			    msj: infodata.msj, // change this to the email field on your form
			};
			jQuery.post(apfajax.ajaxurl, data, function(response) {
			    $li.find(".data-al-user").text(response)
			});
        },
 
        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
 
    });
})

})