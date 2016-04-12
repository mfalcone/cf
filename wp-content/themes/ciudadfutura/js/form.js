$(document).ready(function(){
	$("#main-formulario input").keyup(function(e){
		var me = $(e.target).attr("id");
		if($(e.target).val() == ""){
			$("label[for="+me+"]").css('visibility','visible')

		}else{
			$("label[for="+me+"]").css('visibility','hidden')
		}
		
	})

	$("#sumate").click(function(){
		var nombre = $('#nombre').val();
		var domicilio = $('#domicilio').val();
		var fecha = $('#nacimiento').val();
		var telefono = $('#celular').val();
		var email = $('#mail').val();
		var facebook = $('#facebook').val();
		var twitter = $('#twitter').val();
		var distrito;
		if($("input[type=radio]:checked").size()){
			distrito = $("input[type=radio]:checked").val();
		}else{
			distrito = "";
		}
		var ocupacion = $("#ocupacion").val();
		var aporte = $("#aporte").val();

		var jason = {
			'nombre':nombre,
			'domicilio':domicilio,
			'fecha':fecha,
			'telefono':telefono,
			'email':email,
			'facebook':facebook,
			'twitter':twitter,
			'distrito':distrito,
			'ocupacion':ocupacion,
			'aporte':aporte
		}

		$.ajax({
			type: "POST",
			cache: false,
			url: $("#main-formulario").data("form")+"/afiliado.php",
			data: "data="+JSON.stringify(jason),
			success: function(data) {
				alert(data);
			}
		});
	})
});
		