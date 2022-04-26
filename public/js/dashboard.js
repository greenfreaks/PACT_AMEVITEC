$(document).ready(function() {
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'technology/getAllTech',
		success: function(data) {
			//console.table(data);
			if (data.error) {
				console.error(data.message);
			} else {
				console.log(data.msg);
				let auxString = '';
				for (tech of data.technologies) {
					auxString += `
          <div class="col l6 s12">
            <div class="card gris-claro">
                <div class="card-content">
                  <span class="card-title">Tecnología: ${tech.techname}</span>
                </div>
                <div class="card-action right-align">
                  <a id='btn-id' href='technology/verproyecto/${tech.id}' class='waves-effect waves-light btn'><i class='material-icons left'>add</i>Detalles</a>
                </div>
            </div>
          </div>`;
				}
				$('#row_techs').html(auxString);
				//window.location.href = 'http://localhost/pruebas/test/PACT2/';
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
