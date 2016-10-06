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

})