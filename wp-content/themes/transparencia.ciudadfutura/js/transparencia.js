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

window.aporte ="";

$("#contact_form .dinero span").click(function(){
	aporte = $(this).data("check");
})

$("#otro_input").change(function(){
	aporte = $(this).val();
})


	function validateEmail(email) 
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}



	$("#enviar").click(function(){
		var nombre = $('#nombre').val();
		if(nombre==""){
			alert("por favor ingrese su nombre")
			return;	
		}
		var domicilio = $('#direccion').val();
		var telefono = $('#telefono').val();
		var email = $('#mail').val();
		var dni = $('#dni').val();
		var cuil = $('#cuil').val();
		var localidad = $('#localidad').val();
		var codigo = $('#codigo').val();
		
		mailvalido = validateEmail(email);
		if(!mailvalido){
			alert("por favor ingreso una dirección de correo válida")
			return;
		}
		if(window.aporte==""){
			alert("por favor ingresá tu aporte");
			return;
		}
		var facebook = $('#facebook').val();
		var ocupacion = $("#ocupacion").val();
		var aporte = $("#aporte").val();

		var jason = {
			'nombre':nombre,
			'domicilio':domicilio,
			'dni':dni,
			'telefono':telefono,
			'email':email,
			'facebook':facebook,
			'cuil':cuil,
			'localidad':localidad,
			'codigo':codigo,
			'aporte':window.aporte
		}
		console.log(jason)
		$.ajax({
			type: "POST",
			cache: false,
			url: $("#contact_form").data("form")+"/aporte.php",
			data: "data="+JSON.stringify(jason),
			success: function(data) {
				alert(data);
			}
		});
	})

	$(".concejales .bt").click(function(){
		var $modal = $(this).next();
		$modal.wrap( "<div class='modal-wrap'></div>" );
		$modal.show();
		if(!$modal.find(".close").size()){
			$modal.append('<span class="close glyphicon glyphicon-remove"></span>');
			$modal.find(".close").click(function(e){
				$modal.hide();
				$modal.unwrap();
			})
		}
	})

})