
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
     //return resultado;
    
	if(nivel=='primero'){
		
		if(checksApagados('check-registrar-como')){
			jError('Debe definir como desea registrar su sede'); 
			return false;
		}
	}
	else if(nivel=='segundo'){
		if($('#form_nombre').val()=="Nombre del Sede (Max 20 carácteres)" || $('#form_nombre').val()==""){
			jError('Debe indicar el nombre de su sede'); 
			return false;
		}
		if($('#form_descripcionGeneral').val()=="Descripción general" || $('#form_descripcionGeneral').val()==""){
			jError('Debe describir su sede'); 
			return false;
		}
		if($('input[type=file]').val()==""){
			jError('Debe subir por lo menos una imagen de su sede'); 
			return false;
		}
	}
	else if(nivel=='tercero'){

		if(checksApagados('check-accesibilidad')){
			jError('Debe definir la accesibilidad de la sede'); 
			return false;
		}
		if(checksApagados('check-tipo-sede')){
			jError('Debe definir el tipo de sede'); 
			return false;
		}

	}
	else if(nivel=='cuarto'){

		if(checksApagados('check-configuracion')){
			jError('Debe definir las configuraciones permitidas en su sede'); 
			return false;
		}
		if(checksApagados('check-actividad-permitida')){
			jError('Debe definir las actividades permitidas en su sede'); 
			return false;
		}

	}
	else if(nivel=='quinto'){
		if(checksApagados('check-aceptacion-reserva')){
			jError('Debe indicar un modo de aceptación de la reserva'); 
			return false;
		}
		if(checksApagados('check-facturacion-pago')){
			jError('Debe definir los parametros de facturación'); 
			return false;
		}
		if(!parseFloat($('#form_precioPorHora').val())>0){
			jError('Debe especificar un precio de alquiler para su sede, ejemplo 500'); 
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
	

	var data = 'valor='+$("#form_provincia").val();	 
	$('#form_localidad').find('option').remove().end();

	$.post(direccionBuscarCiudad, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);

		var newOptions = respuesta.elementos;
		var select = jQuery('#form_localidad');
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
