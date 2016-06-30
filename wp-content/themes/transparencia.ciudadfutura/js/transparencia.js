jQuery(document).ready(function($){

	$(".equipo .glyphicon").click(function(){
		$(this).next().slideToggle();
	})


	/*$(window).scroll(function(){
		var barra = $(window).scrollTop();
		var posicion =  (barra * 1);
		var pitu = (barra * 0.20);
		var caren = (barra * 0.10);
		$('header').css({
			'background-position': '0 -' + posicion + 'px',
		});

		$('#pitu').css({
			'background-position': '0 -' + pitu + 'px',
		});

		$('#caren').css({
			'background-position': '0 ' + caren + 'px',
		});
 
	});*/

	$(".menulink .glyphicon").click(function(){
		$("#menu-menu-principal").slideToggle();
	})

})