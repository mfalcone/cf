jQuery(document).ready(function($){
	/*SVG MAP*/
	$("polygon, path").click(function(){
		var id = $(this).attr("id");
		console.log("me toma")
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
	$(".gallery a").click(function(e){
		e.preventDefault();
		imgurl = $(this).attr("href");
		$img = $('<img src="'+imgurl+'"/>');
		$(".modal-wrapper .inner-modal").html($img);
		$(".modal-wrapper .inner-modal").parent().attr("class","modal col-md-10 col-md-offset-1")
		$(".modal-wrapper").fadeIn();
	})


	$(".humor a").click(function(e){
		e.preventDefault();
		imgurl = $(this).attr("href");
		$img = $('<img src="'+imgurl+'"/>');
		$(".modal-wrapper .inner-modal").html($img);
		$(".modal-wrapper .inner-modal").parent().attr("class","modal col-md-10 col-md-offset-1")
		$(".modal-wrapper").fadeIn();
		$(".modal-wrapper div").removeClass("container");
	})
	

	$("#main-header h4").click(function(){
		$(this).toggleClass("selected");
		$(".meses").toggle();
	})

})	