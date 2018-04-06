<script type="text/javascript">

$(document).ready(function() {

	$('#ingresosvisitantes-table').DataTable({
		"aoColumnDefs": [{
			"bSortable": false,
			//"aTargets": [6]
		}],
		"searching": true,
		"lengthChange": false,
		"lengthMenu": [[10], [10]],
		"order": [[ 5, 'desc' ]],
		"language": {
			"sProcessing":    "Procesando...",
			"sLengthMenu":    "Mostrar _MENU_ registros",
			"sZeroRecords":   "No se encontraron resultados",
			"sEmptyTable":    "Ningún dato disponible en esta tabla",
			"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":   "",
			"sSearch":        "Buscar:",
			"sUrl":           "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":    "Último",
				"sNext":    "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
});

$(document).ready(function() {

	$('#egresosvisitantes-table').DataTable({
		"aoColumnDefs": [{
			"bSortable": false,
			//"aTargets": [6]
		}],
		"searching": true,
		"lengthChange": false,
		"lengthMenu": [[10], [10]],
		"order": [[ 5, 'desc' ]],
		"language": {
			"sProcessing":    "Procesando...",
			"sLengthMenu":    "Mostrar _MENU_ registros",
			"sZeroRecords":   "No se encontraron resultados",
			"sEmptyTable":    "Ningún dato disponible en esta tabla",
			"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":   "",
			"sSearch":        "Buscar:",
			"sUrl":           "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":    "Último",
				"sNext":    "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});
});

$( "#form-create" ).submit(function( event ) {
	event.preventDefault(event);
	swal({
		title: '¿Está seguro que quiere ingresar al visitante?',
		type: "warning",
		showCancelButton: true,
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Aceptar',
		closeOnConfirm: true
	}, function(confirmed) {
		if (confirmed) {
			$("#form-create").off("submit").submit();
		}
	});
});

$( "#form-edit" ).submit(function( event ) {
	event.preventDefault(event);
	swal({
		title: '¿Está seguro que quiere egresar al visitante?',
		type: "warning",
		showCancelButton: true,
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Aceptar',
		closeOnConfirm: true
	}, function(confirmed) {
		if (confirmed) {
			$("#form-edit").off("submit").submit();
		}
	});
});

//FUNCIÓN PARA ELIMINAR UN BANCO
var Eliminar = function(id, nombre)
{
	// ALERT JQUERY
	swal({
		title: '¿Está seguro que quiere eliminar el equipo ó bien?',
		text: ' Usted no podrá recuperar el registro ' + nombre,
		type: "warning",
		showCancelButton: true,
		cancelButtonText: 'Cancelar',
		confirmButtonText: 'Aceptar',
		closeOnConfirm: true
	}, function(confirmed) {
		if (confirmed) {
			var route = "{{url('equipos_bienes')}}/"+id+"";
			var token = $("#token").val();
			$.ajax({
				url: route,
				headers: {'X-CSRF-TOKEN': token},
				type: 'DELETE',
				dataType: 'json',
				success: function(data) {
					if (data.success == 'true')
					{
						var url='{{ url('EquiposBienes')}}';
						location.href = url;
						//Alerta de Confirmación
						swal({
							title: 'Equipo ó Bien Eliminado',
							text: "",
							type: 'success'
						});
					}
				},
				error:function(data)
				{
					switch (data.status) {
						case 400:
						$("#message-error-delete").show().html("Servidor ha entendido la solicitud, pero el contenido de solicitud no es válida.");
						break;
						case 422:
						var errors = '<ul>';
						for (datos in data.responseJSON)
						{
							errors += '<li>' +data.responseJSON[datos] + '</li>';
						}
						errors += '</ul>';
						$("#message-error-delete").show().html(errors);
						break;
						case 401:
						$("#message-error-delete").show().html("Acceso no autorizado.");
						break;
						case 403:
						$("#message-error-delete").show().html("Prohibido recurso no se puede acceder.");
						break;
						case 405:
						$("#message-error-delete").show().html("Ha ocurrido un error en la aplicación.");
						break;
						case 500:
						$("#message-error-delete").show().html("Error Interno del Servidor.");
						break;
						case 503:
						$("#message-error-delete").show().html("Servicio no disponible.");
						break;
					}
				}
			});
		}
	});
};

</script>
