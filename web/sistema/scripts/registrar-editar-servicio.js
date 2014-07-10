
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
		
		if(checksApagados('check-registrar-como')){
			jError('Debe definir como desea registrar su servicio'); 
			return false;
		}
	}	
	else if(nivel=='segundo'){
		if($('#form_nombre').val()=="Nombre del Servicio (Max 20 carácteres)" || $('#form_nombre').val()==""){
			jError('Debe indicar el nombre de su servicio'); 
			return false;
		}
		if($('#form_descripcionGeneral').val()=="Descripción general" || $('#form_descripcionGeneral').val()==""){
			jError('Debe describir su servicio'); 
			return false;
		}
		if($('input[type=file]').val()==""){
			jError('Debe subir por lo menos una imagen de su servicio'); 
			return false;
		}
		if(checksApagados('check-ofrecidos-por')){
			jError('Debe definir para quien ofrece el servicio'); 
			return false;
		}

	}
	else if(nivel=='cuarto'){
		if(checksApagados('check-tipo-servicio')){
			jError('Debe definir por lo menos un tipo de servicio entre las fases 3 y 4'); 
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
			jError('Debe especificar un precio de alquiler para su servicio, ejemplo 500'); 
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



$("#form_ofrecidosTodos").live("change", function() {

    var elementos  = $('.check-ofrecidos-por');
    if(this.checked) {
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', true);
         });
    }
    else{
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', false);
         });    	
    }
});
$(".check-ofrecidos-por").live("change", function() {
	
     var id = $(this).attr('id');
     var variable = 'form_ofrecidosTodos';

     if(id!=variable) $('#'+variable).prop('checked', false);
});



$("#form_todosMultimedia").live("change", function() {
	
    var elementos  = $('.check-multimedia');
    if(this.checked) {
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', true);
         });
    }
    else{
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', false);
         });    	
    }
});
$(".check-multimedia").live("change", function() {
	
     var id = $(this).attr('id');
     var variable = 'form_todosMultimedia';

     if(id!=variable) $('#'+variable).prop('checked', false);
});



$("#form_todosMejoraEspacios").live("change", function() {
	
    var elementos  = $('.check-mejora-espacios');
    if(this.checked) {
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', true);
         });
    }
    else{
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', false);
         });    	
    }
});
$(".check-mejora-espacios").live("change", function() {
	
     var id = $(this).attr('id');
     var variable = 'form_todosMejoraEspacios';

     if(id!=variable) $('#'+variable).prop('checked', false);
});



$("#form_todosMejoradeContenidos").live("change", function() {
	
    var elementos  = $('.check-mejora-contenidos');
    if(this.checked) {
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', true);
         });
    }
    else{
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', false);
         });    	
    }
});
$(".check-mejora-contenidos").live("change", function() {
	
     var id = $(this).attr('id');
     var variable = 'form_todosMejoradeContenidos';

     if(id!=variable) $('#'+variable).prop('checked', false);
});



$("#form_todosServicioAsistentes").live("change", function() {
	
    var elementos  = $('.check-mejora-servicio-asistentes');
    if(this.checked) {
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', true);
         });
    }
    else{
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', false);
         });    	
    }
});
$(".check-mejora-servicio-asistentes").live("change", function() {
	
     var id = $(this).attr('id');
     var variable = 'form_todosServicioAsistentes';

     if(id!=variable) $('#'+variable).prop('checked', false);
});



$("#form_todosImagenCorporativa").live("change", function() {
	
    var elementos  = $('.check-imagen-corporativa');
    if(this.checked) {
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', true);
         });
    }
    else{
         $.each(elementos, function(indice, valor) {
            $(valor).prop('checked', false);
         });    	
    }
});
$(".check-imagen-corporativa").live("change", function() {
	
     var id = $(this).attr('id');
     var variable = 'form_todosImagenCorporativa';

     if(id!=variable) $('#'+variable).prop('checked', false);
});