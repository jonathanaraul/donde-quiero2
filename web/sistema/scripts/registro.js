 
jQuery('#fos_user_registration_form_provincia').live("change", function() {

	var valor = jQuery(this).val();
	jQuery('#fos_user_registration_form_idLocalidad').find('option').remove().end();

	var data = 'valor=' + valor;
	//$('#fos_user_registration_form_idLocalidad').css('border','1px solid red');

	$.post(direccionBuscarCiudad, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);

		var newOptions = respuesta.elementos;
		var select = jQuery('#fos_user_registration_form_idLocalidad');
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
/*
jQuery("#fos_user_registration_form_marketing").live("change", function() {

	var valor = jQuery(this).val();
	var email =  jQuery('#fos_user_registration_form_email').val();

	jQuery('#fos_user_registration_form_marketingValor').find('option').remove().end();


	var data = 'valor=' + valor+ '&email='+email;
	$.post(direccionRegistroMarketing, data, function(respuesta) {
		var respuesta = JSON.parse(respuesta);
		var newOptions = respuesta.elementos;
		var select = jQuery('#fos_user_registration_form_marketingValor');
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

	});
	return false;
});


 
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
*/