$(document).ready(function(){

	$("#tambo header a").click(function(e){
		e.preventDefault();
		var ID = $(this).data("link");
		$("section").removeClass("active");
		$("section#"+ID).addClass("active");
		hideBlocks(timelineBlocks, offset);
		$("#tambo header a").removeClass("selected");
		$(this).addClass("selected");

		if($(".timeline").is(":visible")){
			elementPosition = $('.timeline').offset();	
		}	
	})

$('#tambo header a:eq(0)').addClass("selected")
	
var timelineBlocks = $('.cd-timeline-block'),
		offset = 0.8;

	//hide timeline blocks which are outside the viewport

$('#tambo .cabecera-tambo h1 .count').text(dayCounter());

$(window).on('scroll', function(){
		(!window.requestAnimationFrame) 
			? setTimeout(function(){ showBlocks(timelineBlocks, offset); }, 100)
			: window.requestAnimationFrame(function(){ showBlocks(timelineBlocks, offset); });

		// fixea el tml de twitter en el scroll
		if($(".timeline").is(":visible")){
			if($(window).scrollTop() > elementPosition.top){
			      $('.timeline').css('position','fixed').css('top','100px');
	        } else {
	            $('.timeline').css('position','static');
	        }  
		}
	});

	

	
	$('.cd-timeline-block:eq(0)').find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');



})

function dayCounter(){
	today = new Date();
	BigDay = new Date("April 19, 2016");
	msPerDay = 24 * 60 * 60 * 1000 ;
	timeLeft = (BigDay.getTime() - today.getTime());
	e_daysLeft = timeLeft / msPerDay;
	daysLeft = Math.floor(e_daysLeft);
	return daysLeft;
}

function hideBlocks(blocks, offset) {
		blocks.each(function(){
			$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden')
			//console.log($(this).find(".cd-timeline-img"));
		});
	}

	function showBlocks(blocks, offset) {
		blocks.each(function(){
			( $(this).offset().top <= $(window).scrollTop()+$(window).height()*offset && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) && $(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
		});
	}