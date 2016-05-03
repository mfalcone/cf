jQuery(document).ready(function(){
	
	$(".main").height($(window).height())
	initAnimate($(".main section:eq(0)"));
	$(".main").onepage_scroll({
	   sectionContainer: "section", 
	   easing: "ease",
	   animationTime: 1000,
	   pagination: false,   
	   updateURL: true,  
	   beforeMove: function(index) {

	   },
	   afterMove: function(index) {
	   		index = index-1
	   	   	initAnimate($(".main section:eq("+index+")"))
		},   
	   loop: true,                   
	   keyboard: true,                 
	   responsiveFallback: false,     
	   direction: "vertical"            
	});


})


initAnimate = function($elem){

	$elem.find(".actor").each(function(ind,el){
		ind = $(el).index();
		$(el).delay(ind*1000).fadeIn();
	})

}