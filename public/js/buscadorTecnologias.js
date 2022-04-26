$(document).ready(function() {
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'buscadorTecnologias/getTech',
		success: function(data) {
			console.log(data);
			if (data.error) {
				console.error(data.message);
			} else {
                console.log(data);
				console.log(data.msg);
				let infoTech = "";
				for (tech of data.tecnologias) { // 
					infoTech += '<tr class="active-row">' +
					'<td class="center">' + tech.idtecnologia + '</td>'+
					'<td class="center">' + tech.nombre + '</td>' +
					'</tr>'
				}
				$('.table').append(infoTech);
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