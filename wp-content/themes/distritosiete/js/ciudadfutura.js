$(document).ready(function(){
      $("#searchsubmiticon").on("click",function(e){
      	e.preventDefault();
      	$("header #searchform").toggleClass("buscador");
      })

      $("#main-header .icon").on("click",function(){
      	$("#main-header .menu-principal-container").toggle();
      })

      if (window.matchMedia('(max-width: 768px)').matches){

      	var images=new Array('uno.jpg','dos.jpg','tres.jpg','cuatro.png','cinco.jpg');
		var nextimage=0;

		doSlideshow();

		function doSlideshow()
		{
		    if($('.slideshowimage').length!=0)
		    {
		        $('.slideshowimage').fadeOut(500,function(){slideshowFadeIn();$(this).remove()});
		    }
		    else
		    {
		        slideshowFadeIn();
		    }
		}
		function slideshowFadeIn()
		{
		    $('.slideshow').prepend($('<img class="slideshowimage" src="'+location.href+'wp-content/themes/ciudadfutura/img/'+images[nextimage++]+'" style="display:none">').fadeIn(500,function(){setTimeout(doSlideshow,2000);}));
		    if(nextimage>=images.length)
		        nextimage=0;
		}
		    // do functionality on screens smaller than 768px
		}
});
		