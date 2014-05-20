$(".funcionGestion").live("click", function() {

	var tipo = $(this).attr('tipo');
	var tarea = $(this).attr('tarea');
	var identificador = $(this).attr('identificador');
    var valor = null;

    var contenido = $(this).html();
	if(tarea=='estado'){
		if(contenido=='Activo'){
			$(this).html('Inactivo');
			valor = 0;
		}
		else if(contenido=='Inactivo'){
			$(this).html('Activo');
			valor = 1;
		}
	}
	else if(tarea=='rol'){
		if(contenido=='Administrador'){
			$(this).html('Usuario');
			valor = 0;
		}
		else if(contenido=='Usuario'){
			$(this).html('Administrador');
			valor = 1;
		}
	}

	var data = 'tipo=' + tipo + '&tarea=' + tarea + '&identificador=' + identificador + '&valor='+valor;

/*
	$.post(direccionFuncionGestion, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		var elementos = respuesta['arreglo']['elementos'];
		markers = new Array(elementos.length);
		colocaMarcador(elementos);
	});
*/
});

$('.botonGestion').live("click", function() {

	var tipo = $(this).attr('tipo')

	var direccion = '';
	
	switch(tipo) {
		case 'Ingresos':
		direccion = direccionIngresos;
		break;
		case 'Usuarios':
		direccion = direccionUsuarios;
		break;
		case 'Espacios':
		direccion = direccionEspacios;
		break;
		case 'Eventos':
		direccion = direccionEventos;
		break;
		case 'Servicios':
		direccion = direccionServicios;
		break;
		case 'Sedes':
		direccion = direccionSedes;
		break;
	}

	document.location.href = direccion;


});

$('#buscarGestion').live("click", function() {
	$('#formularioGestion').submit();
});
