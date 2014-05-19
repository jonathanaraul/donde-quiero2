$('#botonBorrarReserva').live("click", function() {

    var tarea = 'borrar';
	var id = $(this).attr('reserva');
	procesaNotiticacionReserva(id,tarea);
	$(this).parent().parent().parent().remove();

});
$('#botonAprobarReserva').live("click", function() {

    var tarea = 'aprobar';
	var id = $(this).attr('reserva');
	procesaNotiticacionReserva(id,tarea);
	$(this).parent().parent().prev().find('.estado-reserva').html('Aprobada');
	$(this).remove();
});
$('#botonCancelarReserva').live("click", function() {

    var tarea = 'cancelar';
	var id = $(this).attr('reserva');
	procesaNotiticacionReserva(id,tarea);
	$(this).parent().parent().prev().find('.estado-reserva').html('Cancelada');
	$(this).remove();
});
function procesaNotiticacionReserva(id,tarea) {
	var data = 'id='+id+'&tarea='+tarea;
	
	$.post(direccionNotiticacionReserva, data, function(respuesta) {
	});

}