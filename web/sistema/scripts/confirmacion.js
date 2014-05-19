$('#botonRealizarPago').live("click", function() {

    if(checksApagados('confirmacion')){
	jError('Debe aceptar las condiciones de reserva'); 
			return false;
		}

	$("#contenido").css('display', 'none');
	$("#loader").css('display', 'block');
    
    var informacionAdicional = $("#informacionAdicional").val();
    if(informacionAdicional=='Añade información adicional para el propietario')informacionAdicional='';

	var data = 'informacionAdicional='+informacionAdicional;

	$.each($(".confirmacion"), function(indice, valor) {
		var auxiliar = $.trim($(valor).val());
		var id = $(valor).attr('id');
		data += '&'+id + '=' + auxiliar;
	});

	$.post(direccionConfirmacionGuardar, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		document.location.href = respuesta.url;
		//console.dir(respuesta);
		//$("#loader").css('display', 'none');
		//$("#elementos-espacio-verde").append(respuesta.htmlElementos);
	});

});