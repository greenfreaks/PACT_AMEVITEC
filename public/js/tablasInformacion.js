$(document).ready(function() {
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'tablasInformacion/getAllInstituciones',
		success: function(data) {
			console.log(data);
			if (data.error) {
				console.error(data.message);
			} else {
                console.log(data);
				console.log(data.msg);
				let nombreInstitucion = "";
				for (ins of data.instituciones) { // 
					nombreInstitucion += '<tr class="active-row">' +
					'<td>' + ins.nombre_institucion + '</td>'+
					'<td>' + ins.id_institucion + '</td>' +
					'<td>' + ins.id_institucion + '</td>' +
					'</tr>'
				}
				$('#myTable').append(nombreInstitucion);
			}
		},
		error: function(e) {
			console.error(e);
			M.toast({
				html:
					'⚠ Ocurrio un error al enviar sus datos, por favor recargue la pagina e intente de nuevo ⚠'
			});
		},
		beforeSend: function() {
			console.log('Inicio de envio de datos');
			console.group();
		},
		complete: function() {
			console.groupEnd();
			console.log('Fin de envio de datos');
		}
	});

	M.AutoInit();
});
