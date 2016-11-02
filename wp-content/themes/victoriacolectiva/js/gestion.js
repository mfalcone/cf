jQuery(document).ready(function(){
jQuery(".admin-control span").click(function(e){
	
	var posttitle = "este es el titulo";
 	
    $li = jQuery(this).parents('li');
    var usuario = $li.find(".activity-header p a:eq(0)").text();
    var link = $li.find(".activity-header .activity-time-since").attr("href");
    var content = $li.find(".activity-inner").html();
     var autor = usuario;
     var vinculo = link;
     var postcontent = content;
     console.log(content);
	jQuery.ajax({
 
        type: 'POST',
 
        url: apfajax.ajaxurl,
 	  data: {
            action: 'apf_addpost',
            apftitle: posttitle,
            apfcontents: postcontent,
            autor: autor,
            vinculo: vinculo,
        },
 
        success: function(data, textStatus, XMLHttpRequest) {
            alert("bien");
        },
 
        error: function(MLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
 
    });
})

})