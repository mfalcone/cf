  (function($) {
  	$(document).ready(function(){

	  $('.card div.front, .card div.back').click(function(){
	  	$(this).parent().toggleClass('flipped');
	  })
	  $(".propuestas:not(header .propuestas)").find("article").hide()
	  $(".propuestas:not(header .propuestas)").append('<div class="cargando">cargando...</div>')
	 
	  
	})
	window.onresize=function(){
		$('article').height($('.card img').outerHeight()+8);
	}

	$(window).load(function() {
		$(".propuestas .cargando").hide();
		$(".propuestas article").show();

       $('article').height($('.card img').outerHeight()+8);
});
	
  }(jQuery));