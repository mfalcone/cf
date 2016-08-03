jQuery(document).ready(function($){
	/*SVG MAP*/
	$("polygon").click(function(){
		var id = $(this).attr("id");
		texto = noticias[id];
		$(".modal-wrapper .inner-modal").text(texto)
		$(".modal-wrapper").fadeIn();
		//alert(texto);
	})

	$(".modal-wrapper .cerrar").click(function(){
		$(".modal-wrapper").fadeOut();
	})

})