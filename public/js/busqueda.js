$(document).ready(function() {
	console.log('busqueda ready');
	//Insert code here
	$('#search_results').hide();
	$('#sin_usuarios').hide();
	$('#sin_tecnologias').hide();
	//TODO Leo ajax busqueda

	$('#form-busqueda').submit(function(e) {
		e.preventDefault();
		// let formData = objectifyForm($('#form-busqueda').serializeArray());
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'busqueda/getSearchResults',
			data: $('#form-busqueda').serialize(), // serializes the form's elements.
			success: function(result) {
				if (result.error) {
					console.error(result.msg);
					M.toast({
						html: `<span class='red-text'>Error al recibir los datos, verifique el formulario</span>`
					});
				} else {
					console.log(result.msg);

					if (!result.matchUsers) {
						console.error('Error busqueda de Usuarios - no se recibieron datos');
						$('#sin_usuarios').show();
					} else if (result.matchUsers.length > 0) {
						$('#sin_usuarios').hide();
						//TODO Resultados busqueda usuarios
						result_usuarios = `<li>
						<div class="collapsible-header">Gustavo Leondardo Castañeda Martinez</div>
							<div class="collapsible-body">
								<p><span class="negritas">Correo: </span></p>
								<p><span class="negritas">Total de proyectos: </span></p>
								<ul class="collection">
									<li class="collection-item"><div>Nombre de proyecto | TRL:  
											<a href="#!" class="secondary-content">
												<i class="material-icons">send</i>
											</a>
										</div>
									</li>
								</ul>
							</div>
						</li>`;

						$('#tech_results').append(result_usuarios);
					} else {
						$('#sin_usuarios').show();
					}

					if (!result.matchProjects) {
						console.error('Error busqueda de Proyectos - no se recibieron datos');
						$('#sin_tecnologias').show();
					} else if (result.matchProjects.length > 0) {
						$('#sin_tecnologias').hide();
						//TODO Resultados busqueda usuarios
						result_usuarios = `<a href="#!" class="collection-item">proyecto</a>`;
						$('#tech_results').append(result_usuarios);
					} else {
						$('#sin_tecnologias').show();
					}

					$('#search_results').show('slow');
				}
			},
			error: function(e) {
				console.error(`ERROR JS: ${e}`);
				M.toast({
					html: `<span class='red-text'>⚠ Ocurrió un error al enviar sus datos, por favor recargue la página e intente de nuevo ⚠</span>`
				});
			},
			beforeSend: function() {
				console.log('Inicio de envio de datos');
				console.group('prueba');
			},
			complete: function() {
				console.groupEnd();
				console.log('Fin de envio de datos');
			}
		});
	});
});
