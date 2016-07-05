jQuery(document).ready(function($){

	$(".equipo .glyphicon").click(function(){
		$(this).next().slideToggle();
	})

	$(".menulink .glyphicon").click(function(){
		$("#menu-menu-principal").slideToggle();
	})

	$(".tags .tag").click(function(e){
		$("tr").show();
		var slug = $(e.target).data("href");
		$("tr").each(function(ind,val){
			if(!$(val).is("."+slug)){
				console.log($(val))
				$(val).hide();
			}
		});
		if(!$(".tags #todos").size()){
			$(".tags").append('<span class="tag" id="todos">Mostrar todos</span>')
			$(".tags #todos").click(function(){
				$("tr").show();
				$(this).remove();
			})
		}
	})


})