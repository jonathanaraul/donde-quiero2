
$(".siguiente-formulario").live("click", function() {

	if(ejecutaValidaciones($(this).attr('actual'))==false) return false;

	if($(this).attr('referencia')=="segundo"){
		
		$("#work-primero").removeClass("mostrar");
		$("#work-primero").addClass("ocultar");
	}


	if($(this).attr('referencia')!='envio'){
		$(this).parent().parent().removeClass("mostrar");
		$(this).parent().parent().addClass("ocultar");
		$(this).parent().parent().next().removeClass("ocultar");
		$(this).parent().parent().next().addClass("mostrar");
	}
	else{

		$('#formulario-registro').submit();
	}

});

$(".anterior-formulario").live("click", function() {

	if($(this).attr('referencia')=="primero"){
		
		$("#work-primero").removeClass("ocultar");
		$("#work-primero").addClass("mostrar");
	}
	$(this).parent().parent().removeClass("mostrar");
	$(this).parent().parent().addClass("ocultar");

	$(this).parent().parent().prev().removeClass("ocultar");
	$(this).parent().parent().prev().addClass("mostrar");
});

function ejecutaValidaciones(nivel) {
	 var resultado = true;

	if(nivel=='primero'){
		
		if(!$('#form_propietarioEmpleado').is(":checked") && !$('#form_agenteComercial').is(":checked") && !$('#form_administradorWeb').is(":checked")){
			jError('Debe definir como desea registrar su espacio'); 
			return false;
		}
	}	
	else if(nivel=='segundo'){
		if($('#form_nombreEspacio').val()=="Nombre del Espacio (Max 20 carácteres)" || $('#form_nombreEspacio').val()==""){
			jError('Debe indicar el nombre de su espacio'); 
			return false;
		}
		if($('#form_descripcionGeneral').val()=="Descripción general" || $('#form_descripcionGeneral').val()==""){
			jError('Debe describir su espacio'); 
			return false;
		}
		if($('input[type=file]').val()==""){
			jError('Debe subir por lo menos una imagen de su espacio'); 
			return false;
		}
	}
	else if(nivel=='tercero'){
		if(!parseInt($('#form_superficie').val())>0){
			jError('Debe indicar la superficie de su espacio, ejemplo 500'); 
			return false;
		}
		if(!$('#form_modoAula').is(":checked") && !$('#form_modoBanquete').is(":checked") && !$('#form_modoCocktail').is(":checked")&& !$('#form_modoEscenario').is(":checked")&& !$('#form_modoExposicion').is(":checked")){
			jError('Debe seleccionar por lo menos un modo de uso para su espacio'); 
			return false;
		}
	}
	else if(nivel=='cuarto'){
		if(!$('#form_proyectorPantallaSala').is(":checked") && !$('#form_microfonoAltavoces').is(":checked") && !$('#form_videocamara').is(":checked")&& !$('#form_wifi').is(":checked")&& !$('#form_internetCable').is(":checked")&& !$('#form_maquinaBebidas').is(":checked")&& !$('#form_pizarra').is(":checked")&& !$('#form_conserjeria').is(":checked")&& !$('#form_aireAcondicionado').is(":checked")&& !$('#form_calefaccion').is(":checked")&& !$('#form_otrosServicios').is(":checked")){
			jError('Debe seleccionar por lo menos una de las características que posee su espacio'); 
			return false;
		}
	}
	else if(nivel=='quinto'){
		if(!$('#form_aceptacionReservaAutomatica').is(":checked") && !$('#form_tiempoMaximoAceptacionReservaAutomatica24h').is(":checked") && !$('#form_tiempoMaximoAceptacionReservaAutomatica48').is(":checked")){
			jError('Debe indicar un modo de aceptación de la reserva'); 
			return false;
		}
		if(!$('#form_todas').is(":checked") && !$('#form_similaresCentroRealiza').is(":checked") && !$('#form_formacionTeorica').is(":checked")&& !$('#form_formacionInformatica').is(":checked")&& !$('#form_formacionTaller').is(":checked")&& !$('#form_exposicion').is(":checked")&& !$('#form_ventaFeria').is(":checked")&& !$('#form_deporte').is(":checked")&& !$('#form_espectaculo').is(":checked")&& !$('#form_reunionAsamblea').is(":checked")&& !$('#form_boda').is(":checked")&& !$('#form_fiesta').is(":checked")){
			jError('Debe indicar por lo menos una de las actividades permitidas en su espacio'); 
			return false;
		}
		if(!parseFloat($('#form_precioPorHora').val())>0){
			jError('Debe especificar un precio de alquiler para su espacio, ejemplo 500'); 
			return false;
		}
		if(!$('#form_aceptoCondicionesUsoPoliticaPrivacidad').is(":checked")){
			jError('Debe aceptar las conficiones de uso y las politicas de privacidad'); 
			return false;
		}
		
	}

	return resultado;
}

$("#form_provincia").live("change", function() {
	

	var data = 'provincia='+$("#form_provincia").val();	 
	$('#form_localidad').find('option').remove().end();
	$.post(direccionBuscarCiudad, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);

		for (var i = 0; i < respuesta['localidades'].length; i++) {
			
			$('#form_localidad').append($('<option>', { 
		        value: respuesta['localidades'][i]['id'],
		        text : respuesta['localidades'][i]['nombre']
		    }));
		};


	                                                         });
	return false;     
                                       }
                  );
