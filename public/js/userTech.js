$(document).ready(function() {
	//Insert code here

	let selectedLockedEval = 0;
	//===================informacion de la tecnologia
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'technology/getTechData',
		success: function(data) {
			//console.table(data);
			if (data.error) {
				console.error(data.message);
				M.toast({
					html: `<span class='red-text'>${data.message} </span>`
				});
			} else {
				console.log(data.message);
				$('#techname').html(`Nombre de la Tecnología: ${data.techdata.techname}`);
				$('#div_techdata').append(`<li>
					<div class="collapsible-header "><i class="material-icons expand">expand_more</i>Industrias que se pueden beneficiar de esta tecnología </div>
					<div class="collapsible-body">
						<table class="tg">
							<tr>
								<th >Sector</th>
								<th >Subsector</th>
								<th >Rama</th>
							</tr>
							${data.sectoresIndustriales
								.map(sector => {
									return `
									<tr>
										<td>${sector.sector_scian} </td>
										<td>${sector.subsector_scian} </td>
										<td >${sector.rama_scian} </td>
									</tr>`;
								})
								.join('')}
						</table>
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons expand">expand_more</i> Soluciones que aporta esta tecnología </div>
					<div class="collapsible-body">
						${data.predicados
							.map(predicado => {
								return `<p>
						Mi(s) <strong>${predicado.tipo}</strong> va(n) dirigido(s) a <strong>${predicado.usuario}</strong> y <strong>${predicado.verbo}</strong> <strong>${predicado.complemento}</strong>
						</p>`;
							})
							.join('')}
					</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons expand">expand_more</i> Objetivos ONU </div>
					<div class="collapsible-body">
						<div class="row">
						${data.objetivos
							.map(function(key) {
								return `<div class="col l4 s12">
								
								<img class="responsive-img" src="public/img/ONU/${key.id}.png" alt="${key.objetivo}">
								<strong>${key.objetivo}</strong>
								</div>`;
							})
							.join('')}
						</div>
					</div>
				</li>`);

				let auxStringTRL = ``;
				if (data.TRL.length === 0) {
					auxStringTRL += `<h6 class="red-text">Esta tecnología no ha sido evaluada.</h6>`;
				} else {
					auxStringTRL += `
					<ul class="collapsible" id="div_evals">
						${data.TRL.map(evaluacion => {
							mensajeCero =
								evaluacion.nivel == 0
									? '<p class="red-text">Desafortunadamente con el avance actual del proyecto no se puede asignar un nivel TRL.</p>'
									: '';
							return `
						<li>
							<div class="collapsible-header"><i class="material-icons expand">expand_more</i> Evaluacion hecha el ${
								new Date(evaluacion.fecha).toLocaleString('es-MX').split(' ')[0]
							} </div>
							<div class="collapsible-body">
							<div class="row">
								<div class="col l12 s12">
									<h4>Nivel TRL obtenido: ${evaluacion.nivel}</h4>
									${mensajeCero}
								</div>
								<div class="col s12">
								<h6>Resultados:</h6>
									<table class="tg">
										<tr>
											<th>Categoria</th>
											<th>Porcentaje</th>
										</tr>
										${evaluacion.resultados
											.map(resultado => {
												return `
											<tr>
												<td>${resultado.categoria} </td>
												<td>
												${resultado.porcentaje}%
													<div class="progress">
														<div class="determinate" style="width: ${resultado.porcentaje}%"></div>
													</div> 
												</td>
											</tr>`;
											})
											.join('')}
									</table>
								</div>
							</div>
							</div>
						</li>`;
						}).join('')}
                    </ul>`;
				}

		

				$('#user__evaluaciones').append(auxStringTRL);
				$('.collapsible').collapsible();

				$('.lockedEval').on('click', function(e) {
					selectedLockedEval = $(this).data('id');
					console.log(selectedLockedEval);
				});
			}
		},
		error: function(e) {
			console.error(`ERROR JS: ${e}`);
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

	$('#desbloqueo-form').submit(function(e) {
		e.preventDefault();
		let formData = objectifyForm($(this).serializeArray());
		formData['idEval'] = selectedLockedEval;
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'technology/unlockReport',
			data: formData, // serializes the form's elements.
			success: function(data) {
				console.table(data);
				if (data.error) {
					console.error(data.mensaje);
					M.toast({
						html: `<span class='red-text'>${data.mensaje}</span>`
					});
				} else {
					console.log(data.mensaje);
					M.toast({
						html: `<span class='white-text'>${data.mensaje}</span>`
					});
					$('#desbloqueo-form').trigger('reset');
					location.reload();
					window.open(`technology/genPDF/${selectedLockedEval}`, '_blank');
				}
			},
			error: function(e) {
				console.error(`ERROR JS: e`);
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
	});
});
