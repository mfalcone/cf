  (function($) {
  	$(document).ready(function(){

	  $('.card div.front, .card div.back').click(function(){
	  	$(this).parent().toggleClass('flipped');
	  })

	  $('article').height($('.card img').height());
	  
	})
	window.onresize=function(){
		$('article').height($('.card img').height());
	}
  }(jQuery));