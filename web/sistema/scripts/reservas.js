$('#botonContinuarReserva').live("click", function() {

	var data = '';
	var color = $("#colorFicha").val();

	$("#elementos-espacio-"+color).empty();
	$('.buscador').css('display','none');
	$("#loader-widget-"+color).css('display', 'block');

/*
	$.each($(".codigos"), function(indice, valor) {
		var auxiliar = $.trim($(valor).val());
		var id = $(valor).attr('id');
		if(indice>0)data += '&';
		data +=  id + '=' + auxiliar;
	});

	$.post(direccionProcesarReserva, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		console.dir(respuesta);
		$("#loader-widget-verde").css('display', 'none');
		//$("#elementos-espacio-verde").append(respuesta.htmlElementos);
	});
*/
});

$('#botonBorrarReservas').live("click", function() {

	var color = $("#colorFicha").val();
	var data = 'tipo='+$("#tipo").val()+'&idTipo='+$("#idTipo").val();
	$("#elementos-espacio-"+color).empty();
	$('.buscador').css('display','none');
	$("#loader-widget-"+color).css('display', 'block');

	$.post(direccionBorrarReservas, data, function(respuesta) {
		
		document.location.href = direccionReservarEspacio;
	});

});

function actualizaBD() {
	var data = '';

	$.each($(".codigos"), function(indice, valor) {
		var auxiliar = $.trim($(valor).val());
		var id = $(valor).attr('id');
		if(indice>0)data += '&';
		data +=  id + '=' + auxiliar;
	});

	$.post(direccionProcesarReserva, data, function(respuesta) {
	});
}