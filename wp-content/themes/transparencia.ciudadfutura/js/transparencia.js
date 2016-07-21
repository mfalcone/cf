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


	$("#contact_form li span").click(function(){

		$("#contact_form li span").not(this).attr("class","glyphicon glyphicon-unchecked")		

	
		if($(this).attr("class") == "glyphicon glyphicon-unchecked"){
			$(this).attr("class","glyphicon glyphicon-check");
			if($(this).parent().attr("id")=="otro"){
				console.log("mostrar")
				$("#otro_input").show();
			}
		}else{
			$(this).attr("class","glyphicon glyphicon-unchecked");
		}
	
	})


$("#agenda dt").click(function(){
	$(this).next().find("ul").slideToggle();
	if($(this).find("span").attr("class")=="glyphicon glyphicon-triangle-right"){
		$(this).find("span").attr("class","glyphicon glyphicon-triangle-bottom");
	}else{
		$(this).find("span").attr("class","glyphicon glyphicon-triangle-right");	
	}
	$("#agenda dt").not(this).next().find("ul").slideUp();
	$("#agenda dt").not(this).find("span").attr("class","glyphicon glyphicon-triangle-right")
})

})