$("#buscarEspacio").live("click", function() {
	var numResults = $(this).attr('numResults');
	var paginacion = $(".rejilla-espacios").attr('paginacion');
	var proveedor = $(".rejilla-espacios").attr('proveedor');
	var cliente = $(".rejilla-espacios").attr('cliente');
	var idRelacionado = $(".rejilla-espacios").attr('idRelacionado');
	buscar(0, numResults, paginacion, 'verde', 'espacio', direccionBusquedaEspacio,proveedor,cliente,idRelacionado);
});
$('.numero-paginacion-verde').live("click", function() {
	var indice = parseInt($(this).attr('indice'));
	var numResults = $(this).attr('numResults');
	var paginacion = $(".rejilla-espacios").attr('paginacion');
	var proveedor = $(".rejilla-espacios").attr('proveedor');
	var cliente = $(".rejilla-espacios").attr('cliente');
	var idRelacionado = $(".rejilla-espacios").attr('idRelacionado');
	buscar(indice, numResults, paginacion, 'verde', 'espacio', direccionBusquedaEspacio,proveedor,cliente,idRelacionado);
});
$("#buscarEvento").live("click", function() {
	var numResults = $(this).attr('numResults');
	var paginacion = $(".rejilla-eventos").attr('paginacion');
	var proveedor = $(".rejilla-eventos").attr('proveedor');
	var cliente = $(".rejilla-eventos").attr('cliente');
	var idRelacionado = $(".rejilla-eventos").attr('idRelacionado');
	buscar(0, numResults, paginacion, 'rosa', 'evento', direccionBusquedaEvento,proveedor,cliente,idRelacionado);
});
$('.numero-paginacion-rosa').live("click", function() {
	var indice = parseInt($(this).attr('indice'));
	var numResults = $(this).attr('numResults');
	var paginacion = $(".rejilla-eventos").attr('paginacion');
	var proveedor = $(".rejilla-eventos").attr('proveedor');
	var cliente = $(".rejilla-eventos").attr('cliente');
	var idRelacionado = $(".rejilla-eventos").attr('idRelacionado');
	buscar(indice, numResults, paginacion, 'rosa', 'evento', direccionBusquedaEvento,proveedor,cliente,idRelacionado);
});
$("#buscarServicio").live("click", function() {
	var numResults = $(this).attr('numResults');
	var paginacion = $(".rejilla-servicios").attr('paginacion');
	var proveedor = $(".rejilla-servicios").attr('proveedor');
	var cliente = $(".rejilla-servicios").attr('cliente');
	var idRelacionado = $(".rejilla-servicios").attr('idRelacionado');
	buscar(0, numResults, paginacion, 'azul', 'servicio', direccionBusquedaServicio,proveedor,cliente,idRelacionado);
});
$('.numero-paginacion-azul').live("click", function() {
	var indice = parseInt($(this).attr('indice'));
	var numResults = $(this).attr('numResults');
	var paginacion = $(".rejilla-servicios").attr('paginacion');
	var proveedor = $(".rejilla-servicios").attr('proveedor');
	var cliente = $(".rejilla-servicios").attr('cliente');
	var idRelacionado = $(".rejilla-servicios").attr('idRelacionado');
	buscar(indice, numResults, paginacion, 'azul', 'servicio', direccionBusquedaServicio,proveedor,cliente,idRelacionado);
});
function buscar(indice, numResults, paginacion, color, tipo, direccion,proveedor,cliente,idRelacionado) {
	$("#loader-widget-" + color).css('display', 'block');
	//$(".desplegables").css('display','none');
	$("#elementos-" + tipo + "-" + color).empty();
	$(".paginacion-" + color).empty();

	var data = 'numResults=' + numResults + '&indice=' + indice + '&paginacion=' + paginacion+
	           '&proveedor=' + proveedor + '&cliente=' + cliente + '&idRelacionado=' + idRelacionado;

	$.each($("." + color + " select"), function(indice, valor) {
		var auxiliar = $.trim($(valor).val());
		var id = $(valor).attr('name');
		data += '&' + id + '=' + auxiliar;
	});
	console.log(data);

	$.post(direccion, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		console.dir(respuesta);
		$("#loader-widget-" + color).css('display', 'none');
		$("#elementos-" + tipo + "-" + color).append(respuesta.htmlElementos);
		$(".paginacion-" + color).append(respuesta.htmlPaginacion);
	});
}

////////////////////SEDES//////////////////////////////////
$("#buscarSede").live("click", function() {

	for (var i = 0; i < markers.length; i++)
		markers[i].setMap(null);
	markers = new Array();

	var proveedor = $(".rejilla-sedes").attr('proveedor');
	var cliente = $(".rejilla-sedes").attr('cliente');
	var idRelacionado = $(".rejilla-sedes").attr('idRelacionado');
	var data = 'proveedor=' + proveedor + '&cliente=' + cliente + '&idRelacionado=' + idRelacionado;

	$.each($(".rejilla-sedes select"), function(indice, valor) {
		var auxiliar = $.trim($(valor).val());
		var id = $(valor).attr('name');
		data += '&' + id + '=' + auxiliar;
	});

	$.post(direccionBusquedaSede, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		var elementos = respuesta['arreglo']['elementos'];
		markers = new Array(elementos.length);
		colocaMarcador(elementos);
	});

});

function colocaMarcador(respuesta) {

	for (var i = 0; i < respuesta.length; i++) {
		var latitud = respuesta[i]['latitud'];
		var longitud = respuesta[i]['longitud'];
		var nombre = respuesta[i]['nombre'];
		markers[i] = new google.maps.Marker({
			position : new google.maps.LatLng(latitud, longitud),
			map : map,
			title : nombre
		});
	};
}
