$(document).ready(function(){

	$(".bt .escribir").click(function(){
		$(".editor").slideToggle();
	})

function InOut( elem )
{
 elem.delay()
     .fadeIn()
     .delay(2200)
     .fadeOut( 
               function(){ 
                   if(elem.next().length > 0)
                   {InOut( elem.next() );}
                   else
                   {InOut( elem.siblings(':first'));}
                         
                 }
             );
}

	$('.ahora li').hide();
	InOut( $('.ahora li:first') );

	$("#search-terms").focus(function(){
		$(".propiedaes").fadeIn();
	})

	$("#search-terms").blur(function(){
		$(".propiedaes").fadeOut();
	})

	$("#right-sidebar .pestania").click(function(){
		$("#right-sidebar").toggleClass("open");
		$("#colophon").toggleClass("open");
		$("#content").toggleClass("right-side-opens");
	})

	if($("body").hasClass("activity")){
	 	$('.show').stop(true, true).delay(1500).animate({height:'80px'}, 500);
	 	$('#content').stop(true, true).delay(1500).animate({top:'60px'}, 500);
	 	$('#right-sidebar').stop(true, true).delay(1500).animate({top:'80px'}, 500);
	}

	function ocultarSlidesSidebar(){
		$(".quiero ul, .hacer ul").removeClass("active");
		$(".quiero ul, .hacer ul").slideUp(300);
	}
	$(".quiero h3, .hacer h3").click(function(){
		if($(this).next('ul').is(".active")){
			ocultarSlidesSidebar();
		}else{
			ocultarSlidesSidebar();
			$(this).next('ul').addClass("active");
			$(this).next('ul').slideDown(300);
		}
	})
	if($("body").is(".groups") || $("body").is(".page-template-page-blog")){
		$(".hacer h3").trigger("click");
	}
})