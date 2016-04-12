 function calcular(Precio_final){
	var Precio_final = parseInt(Precio_final);
	console.log("Precio Final: "+Precio_final)
	Precio_final = Precio_final-20.32
	console.log("Precio Final: "+Precio_final)

	resultado1 = Precio_final-(0.0766 * Precio_final)
	console.log("resultado1: "+resultado1)
	neto = resultado1 / 1.21
	console.log("neto: "+neto)
	resultado = neto - 65
	console.log("resultado: "+resultado)

	if(resultado > (120*0.29228)){
		console.log("resultado mayor a 120*0.29228")
		diferencia = resultado-120*0.29228;

			if(diferencia > (120*0.37321)){

				console.log("resultado mayor a 120*0.37321")
				numerodeplata = resultado - 120*0.37321 - 120*0.29228;
				console.log("numerodeplata: "+ numerodeplata)
				numero_de_KW = numerodeplata / 0.68941
				console.log("numero_de_KW: "+ numero_de_KW)
				postadekw = numero_de_KW + 240
				console.log("postadekw: "+ postadekw)
				
			}else if(diferencia < (120*0.37321)){
				console.log("diferencia menor a 120*0.37321");
				numero_de_KW = diferencia / 0.37321;
				console.log("numero_de_KW: "+ numero_de_KW)
				postadekw = numero_de_KW + 120
				console.log("postadekw: "+ postadekw)
			}	

	}else if(resultado < (120*0.29228)){
		console.log("resultado mayor a 120*0.29228")
		postadekw = resultado / 0.29228;
		console.log("postadekw: "+postadekw)
	}

console.log("postadekw: "+ postadekw)
calcularKw(postadekw,"diciembre");
calcularKw(postadekw,"marzo");
}

function calcularKw(postadekw,mes){

	if(mes == "marzo"){
		basicoFijo = 130.40;
		kw_primer_tramo = 0.59568;
		kw_segundo_tramo = 0.75817;
		kw_tercer_tramo =1.422;
		CAP = 39
		Ley_12692 = 2.64


	}else{
		basicoFijo = 83.84;
		kw_primer_tramo = 0.37704;
		kw_segundo_tramo = 0.48144;
		kw_tercer_tramo = 0.88933;
		CAP = 25;
		Ley_12692 = 1.70

	}
	console.log(mes)

	console.log("postadekw: "+ postadekw)
	if(postadekw < 120){
		basico = postadekw * kw_primer_tramo;
		console.log("basico:"+ basico)
	}else if(postadekw < 240 && postadekw >= 120){
		segundotramo = (postadekw -  120)*kw_segundo_tramo;
		basico = segundotramo + (120 * kw_primer_tramo)
		console.log("basico:"+ basico)

	}else if(postadekw >= 240){
		tercertramo = (postadekw-240)*kw_tercer_tramo;
		basico = tercertramo + (120 * kw_primer_tramo)+(120 * kw_segundo_tramo)
		console.log("basico:"+ basico)

	}

	basico = basico + basicoFijo;
	Ley_6604 = basico * 0.015
	Ley_23681 = basico * 0.006
	OM_1592__62  = basico * 0.006
	OM_1618__62 = basico * 0.018
	Ley_7797 = basico * 0.06
	IVA = basico * 0.21
	
	ustedpaga = basico +Ley_6604+Ley_23681+OM_1592__62+OM_1618__62+Ley_7797+CAP+IVA+Ley_12692
	console.log("ustedpaga: "+ ustedpaga);

	$resultados = $(".resultados");
	$resultados.find(".basico-"+mes).text("$"+basico.toFixed(2));
	$resultados.find(".Ley_6604-"+mes).text("$"+Ley_6604.toFixed(2));
	$resultados.find(".Ley_23681-"+mes).text("$"+Ley_23681.toFixed(2));
	$resultados.find(".OM_1592__62-"+mes).text("$"+OM_1592__62.toFixed(2));
	$resultados.find(".OM_1618__62-"+mes).text("$"+OM_1618__62.toFixed(2));
	$resultados.find(".Ley_7797-"+mes).text("$"+Ley_7797.toFixed(2));
	$resultados.find(".CAP-"+mes).text("$"+CAP.toFixed(2));
	$resultados.find(".IVA-"+mes).text("$"+IVA.toFixed(2));
	$resultados.find(".Ley_12692-"+mes).text("$"+Ley_12692.toFixed(2));
	$resultados.find(".final-"+mes).text("$"+ustedpaga.toFixed(2));
	$resultados.show();	

	if(mes == "marzo"){
		$("#segundo_aumento").val("Segundo aumento: $"+ustedpaga.toFixed(2))
	}else{
		$("#primer_aumento").val("Primer aumento: $"+ustedpaga.toFixed(2))
	}

}	

$(document).ready(function(){
	$("#user_enter_bt").click(function(){
		var val = $("#user_enter").val();
		calcular(val);
	})

	$("#user_enter_kw").click(function(){
		var val = $("#userkw").val();
		calcularKw(val,"diciembre");
		calcularKw(val,"marzo");
	})
})