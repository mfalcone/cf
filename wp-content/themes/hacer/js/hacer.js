jQuery(document).ready(function($){
	/*SVG MAP*/
	$("polygon, path").click(function(){
		var id = $(this).attr("id");
		if(mesactual.toString().length<=1){
			mesactual = "0"+mesactual;
		}
		var urltoOpen = url+"/"+anio+mesactual+id;
		$(".modal-wrapper .inner-modal").text("cargando...");
		$(".modal-wrapper .inner-modal").load(urltoOpen+" #map-wrapper",function (responseText, textStatus, req) {
			    if (textStatus == "error") {
		         $(".modal-wrapper .inner-modal").text("datos no encontrados, por favor intentá otra seccional");
		        }
		})
		$(".modal-wrapper").fadeIn();
		//alert(texto);*/


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


	$("#main-header h4").click(function(){
		$(this).toggleClass("selected");
		$(".meses").toggle();
	})

	$('form.search-form input[type="search"]').focusin(function() {
		    $('form.search-form').addClass("active");
		});
	$('form.search-form input[type="search"]').focusout(function() {
	    $('form.search-form').removeClass("active");
	});

})	