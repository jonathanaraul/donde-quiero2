  var data ="<ul>" ;$('.amarillo select').find('option').each(function() {
    		



		var campo = $.trim($(this).text());

		/*for (var i = 0; i< campo.length - 1;  i++) {
			if(i!=0) campo[i].capitalize();
			auxiliar += campo[i];
		};
*/

		data += "<br>" +campo;

		//console.log(data);
		//return false;

    	}); data +="</ul>"; document.write(data);

 var data ="<ul>" ;$('.azul select').find('option').each(function() {
    		



		var campo = $.trim($(this).text());
		campo = $.trim(campo.replace("ñ", 'ni'));
		campo = $.trim(campo.replace(":", ''));
		campo = $.trim(campo.replace(/<[^>]+>/g, ''));
		campo = $.trim(campo.replace("+", ''));
		campo = $.trim(campo.replace("-", ''));
		campo = $.trim(campo.replace("(", ''));
		campo = $.trim(campo.replace(")", ''));
		campo = $.trim(campo.replace("%", ''));
		campo = $.trim(campo.replace("á", 'a'));
		campo = $.trim(campo.replace("é", 'e'));
		campo = $.trim(campo.replace("í", 'i'));
		campo = $.trim(campo.replace("una", ''));
		campo = $.trim(campo.replace("para", ''));
		campo = $.trim(campo.replace("y", ''));
		campo = $.trim(campo.replace("ó", 'o'));
		campo = $.trim(campo.replace("ú", 'u'));
		campo = $.trim(campo.replace("°", ''));
		campo = $.trim(campo.replace(/\W/g, ' '));
		campo = $.trim(campo.replace(/\s/g, ''));
		campo = $.trim(campo.replace(/\d/g, ''));
		campo = campo.toLowerCase();

		campo = campo.split(" ");
		var auxiliar ="";
		/*for (var i = 0; i< campo.length - 1;  i++) {
			if(i!=0) campo[i].capitalize();
			auxiliar += campo[i];
		};
*/

		data += "<br>" +campo;

		console.log(data);
		return false;

    	}); data +="</ul>"; document.write(data);


$("#boton-formulario-mensaje").live("click", function() {
	var valor = null;
	var elemento = null;
	var mensajeError = $("#error-mensaje");

	valor = $("#nombre-mensaje").val();
	elemento = $("#nombre-mensaje");


	if(valor == '' ||valor ==  'Nombre'){
		elemento.css('border','1px solid #FF0000');
		mensajeError.html('Debe ingresar su nombre');
		 return false;
	}
	else elemento.css('border','none');

	valor = $("#email-mensaje").val();
	elemento = $("#email-mensaje");
	
	if(valor == '' ||valor ==  'E-mail'){
		elemento.css('border','1px solid #FF0000');
		mensajeError.html('Debe ingresar un email valido');
		 return false;
	}
	else elemento.css('border','none');

	valor = $("#mensaje-mensaje").val();
	elemento = $("#mensaje-mensaje");
	
	if(valor == '' ||valor ==  'Mensaje'){
		elemento.css('border','1px solid #FF0000');
		mensajeError.html('Debe ingresar su mensaje');
		 return false;
	}
	else elemento.css('border','none');

	mensajeError.html('');

	$('#formulario-mensaje').css('display', 'none');

	$("#loader-mensaje").css('display', 'block');
	
	var data = '';

	$.each($("#formulario-mensaje input[type=text],#formulario-mensaje textarea"), function(indice, valor) {
		var auxiliar = $.trim($(valor).val());
		var id = $(valor).attr('id');
		data += '&' + id + '=' + auxiliar;
	});


	$.post(direccionEnviarMensaje, data, function(respuesta) {
		
		$("#loader-mensaje").css('display', 'none');
		$("#exito-mensaje").css('display', 'block');


	});

	//console.log(data);
});
/*
$("#form_provincia").live("change", function() {
	

	var data = 'valor='+$("#form_provincia").val();	 
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
*/



$("#botonAcceder").live("click", function() {
	$('#submitform').submit();
});

$("#usuarioRegistroBoton").live("click", function() {
	$('#usuarioRegistroFormulario').submit();
});
$("#registroUsuario").live("click", function() {

	//if(!validaTodosLosCampos($("input[type=text],input[type=password],textarea").not('.opcional')))return false;

	//if(!validaContrasenias($("input[name=contrasenia1]"), $("input[name=contrasenia2]")))return false;

	$('#forminicio').css('display', 'none');
	$('.enviar').css('display', 'none');
	$("#loader").css('display', 'block');
	
	var eventos = $("#eventos").prop('checked');
	var data = 'eventos='+eventos;

	$.each($("#forminicio input[type=text],#forminicio textarea,#forminicio select,#forminicio input[type=password]"), function(indice, valor) {
		var auxiliar = $.trim($(valor).val());
		var id = $(valor).attr('id');
		data += '&' + id + '=' + auxiliar;
	});
	
	console.log(data);

	$.post(direccionGuardarUsuario, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		console.dir(respuesta);
		$("#loader").css('display', 'none');
		$('.inicio').append('<p style="text-align: center;font-weight: bold;">'+respuesta.texto+'...</p>');


	});

	//console.log(data);
});



$("#enviarSolicitudBaja").live("click", function() {

	var razon = $.trim($("#razonSolicitudBaja").val());
	var actual = $(this);

	if(razon == '' ||razon ==  'Describa la razón por la que quiere dar de baja este perfil'){
		$("#datos-razon-baja").css('border','1px solid #FF0000');
		 return false;
	}
	else $("#datos-razon-baja").css('border','none');

	var data = 'razon='+razon;

	console.log(data);

	$.post(direccionEnviarSolicitudBaja, data, function(respuesta) {

		actual.attr('id','cancelarSolicitudBaja');
		actual.html('Cancelar solicitud de baja');

	});
});
$("#cancelarSolicitudBaja").live("click", function() {


	var data = '';
	var actual = $(this);
	

	$.post(direccionCancelarSolicitudBaja, data, function(respuesta) {

		actual.attr('id','enviarSolicitudBaja');
		actual.html('Enviar solicitud de baja');
		$("#razonSolicitudBaja").val('');

	});

	//console.log(data);
});