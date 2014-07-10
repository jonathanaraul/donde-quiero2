
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
		
		if(!$('#evento_propietarioEmpleado').is(":checked") && !$('#evento_agenteComercial').is(":checked") && !$('#evento_administradorWeb').is(":checked")){
			jError('Debe definir como desea registrar su evento'); 
			return false;
		}
	}	
	else if(nivel=='segundo'){
		if($('#evento_nombre').val()=="Nombre del Evento (Max 20 carácteres)" || $('#evento_nombre').val()==""){
			jError('Debe indicar el nombre de su evento'); 
			return false;
		}
		if($('#evento_descripcionGeneral').val()=="Descripción general" || $('#evento_descripcionGeneral').val()==""){
			jError('Debe describir su evento'); 
			return false;
		}
		if($('input[type=file]').val()==""){
			jError('Debe subir por lo menos una imagen de su evento'); 
			return false;
		}
		if( $('#evento_duracionTotal').val()=="" || $('#evento_duracionTotal').val()=="Duración en Horas"){
			jError('Debe definir la duración de su evento'); 
			return false;
		}


	}
	else if(nivel=='tercero'){

        if(!$('#evento_formacionTeorica').is(":checked") && !$('#evento_formacionInformatica').is(":checked") && !$('#evento_formacionTaller').is(":checked") && !$('#evento_exposicion').is(":checked")  && !$('#evento_ventaFeria').is(":checked")  && !$('#evento_deporte').is(":checked")  && !$('#evento_espectaculo').is(":checked")  && !$('#evento_reunionAsamblea').is(":checked")  && !$('#evento_boda').is(":checked")  && !$('#evento_fiesta').is(":checked")&& !$('#evento_jardineria').is(":checked")  ){
			jError('Debe definir su tipo de evento'); 
			return false;
        }
        if(checksApagados('check-configuracion')){
			jError('Debe definir el tipo de disposición y la capacidad del aforo'); 
			return false;
		}
	}
	else if(nivel=='cuarto'){
		if(!$('#evento_aceptacionReservaAutomatica').is(":checked") && !$('#evento_tiempoMaximoAceptacionReservaAutomatica24h').is(":checked") && !$('#evento_tiempoMaximoAceptacionReservaAutomatica48').is(":checked")){
			jError('Debe indicar un modo de aceptación de la reserva'); 
			return false;
		}
		if(!$('#evento_datosFacturacionPagoDelUsuario').is(":checked") && !$('#evento_anadirDatosFacturacionPago').is(":checked")){
			jError('Debe indicar el tipo de procesamiento de pagos'); 
			return false;
		}
		if(!parseFloat($('#evento_precio').val())>0){
			jError('Debe especificar un precio para su evento, ejemplo 500'); 
			return false;
		}
		if(!$('#evento_aceptoCondicionesUsoPoliticaPrivacidad').is(":checked")){
			jError('Debe aceptar las conficiones de uso y las politicas de privacidad'); 
			return false;
		}
	}


	return resultado;
}

$("#form_provincia").live("change", function() {
	

	var data = 'valor='+$("#form_provincia").val();	 
	
	$('#evento_localidad').find('option').remove().end();

	$.post(direccionBuscarCiudad, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);

		var newOptions = respuesta.elementos;
		var select = jQuery('#evento_localidad');
		if(select.prop) {
			var options = select.prop('options');
		}
		else {
			var options = select.attr('options');
		}
		$('option', select).remove();

		$.each(newOptions, function(val, text) {
			options[options.length] = new Option(text, val);
		});
		//$('#fos_user_registration_form_idLocalidad').css('border','none');


	});
	return false;     
                                       }
                  );
