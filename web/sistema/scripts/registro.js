 
$('#formProvincia').live("change", function() {

	var data = 'provincia='+$(this).val();	 
	$('#fos_user_registration_form_idLocalidad').find('option').remove().end();
	$('#fos_user_registration_form_idLocalidad').css('border','1px solid red');

	$.post(direccionBuscarCiudad, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		for (var i = 0; i < respuesta['localidades'].length; i++) {
			$('#fos_user_registration_form_idLocalidad').append($('<option>', { 
		        value: respuesta['localidades'][i]['id'],
		        text : respuesta['localidades'][i]['nombre']
		    }));
		};
		$('#fos_user_registration_form_idLocalidad').css('border','none');
	                                                         }
	      );
	return false;     
                                               }
                       );