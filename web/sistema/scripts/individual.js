
$("#editarElemento").live("click", function() {
	document.location.href = direccionEditar;
});

$("#publicarElemento").live("click", function() {

	var tipo = $(this).attr('tipo');
	var tarea = $(this).attr('tarea');
	var identificador = $(this).attr('identificador');
    var valor = null;

    var titulo = $(this).find('.elementoEstado');
    var contenido = titulo.html();

	if(tarea=='estado'){
		if(contenido=='Despublicar'){
			titulo.html('Publicar');
			valor = 0;
		}
		else if(contenido=='Publicar'){
			titulo.html('Despublicar');
			valor = 1;
		}
	}
	var data = 'tipo=' + tipo + '&tarea=' + tarea + '&identificador=' + identificador + '&valor='+valor;
	$.post(direccionFuncion, data, function(respuesta) {
	});
});
$(".editarElemento2").live("click", function() {





});
