$(window).load(function(){
	$twitterbox = $(".twitter-timeline");
	$parap = $twitterbox.parent("p");
	$twitterbox.css("margin-left",($parap.width()/2)-($twitterbox.width()/2)+"px");
	$(".facebook-album-container a").fancybox({ helpers: { title: null }})
})