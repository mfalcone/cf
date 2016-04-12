$(document).ready(function(){

	function validateEmail(email) 
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

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
		if(nombre==""){
			alert("por favor ingrese su nombre")
			return;	
		}
		var domicilio = $('#domicilio').val();
		var fecha = $('#nacimiento').val();
		var telefono = $('#celular').val();
		var email = $('#mail').val();

		mailvalido = validateEmail(email);
		if(!mailvalido){
			alert("por favor ingreso una dirección de correo válida")
			return;
		}

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
		