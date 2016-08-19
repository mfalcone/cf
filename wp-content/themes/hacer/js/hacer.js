jQuery(document).ready(function($){
	/*SVG MAP*/
	$("polygon, path").click(function(){
		var id = $(this).attr("id");
		console.log(id)
		
		var title = id.split("_");
		title = title[1];
		texto = noticias[id];
		var text_full = "<h2>Noticias sobre la Seccional "+title+"</h2>";
		text_full += "<p>"+texto+"</p>";
		$(".modal-wrapper .inner-modal").html(text_full)
		$(".modal-wrapper").fadeIn();
		//alert(texto);
	})

	$(".modal-wrapper .cerrar").click(function(){
		$(".modal-wrapper").fadeOut();
	})

})	