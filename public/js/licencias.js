$(document).ready(function() {
	let divBusqueda = document.getElementById('busqueda_empresario');
	let divResultados = document.getElementById('resultados_busqueda_empresario');
	divResultados.style.display = 'none';

	$('#busqueda_empresario').submit(function(event) {
		event.preventDefault();

		let formData = {
			email: document.getElementById('input-busqueda').value
		};

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'licencias/searchUser',
			data: formData, // serializes the form's elements.
			success: function(data) {
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

					let divgenlicence = document.getElementById('genlicence');
					divgenlicence.innerHTML = data.resultados
						.map(resultado => {
							return `
							<div class="row">
								<div class="col l6 s12">
									<p><span class="negritas">Nombre: </span>${resultado.nombre}</p>
									<p><span class="negritas">Empresa: </span>${resultado.empresa}</p>
								</div>
								<div class="col l6 s12">
									<p><span class="negritas">Licencias Generadas: </span>${
										resultado.numLicencias
									}</p>
									<p><span class="negritas">Licencias Usadas: </span>${
										resultado.licenciasUsadas
									}</p>
									<a id="btn-descargar_licencias" class='waves-effect waves-light btn green' data-id="${
										resultado.id
									}">Descargar</a>
								</div>
							</div>
							<div class="row valign-wrapper ">
								<div class='input-field col l4 s6'>
									
									<input value="1" min="1" max="100" id='input-numero_licencias' name='numero_licencias' type='number' class='validate' required>
									<span class='helper-text' data-error='Dato no válido' data-success='Dato válido'>
										Ingrese numero de licencias
									</span>
								</div>
								<div class='col l6 s6 '>
									<a id="btn-generar_licencias" class='waves-effect waves-light btn' data-id="${
										resultado.id
									}">Generar</a>
								</div>
							</div>
							
							
							`;
						})
						.join('');
					divBusqueda.style.display = 'none';
					divResultados.style.display = '';

					$('#btn-generar_licencias').on('click', function(e) {
						e.preventDefault();
						let formadata = {
							id: this.getAttribute('data-id'),
							licencias: document.getElementById('input-numero_licencias').value,
							email: document.getElementById('input-busqueda').value
						};
						solicitarLicencias(formadata);
					});

					$('#btn-descargar_licencias').on('click', function(e) {
						e.preventDefault();
						let formadata = {
							id: this.getAttribute('data-id'),
							licencias: document.getElementById('input-numero_licencias').value,
							email: document.getElementById('input-busqueda').value
						};
						descargarLicencias(formadata);
					});
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

	function descargarLicencias(formData) {
		const rows = [
			['name1', 'city1', 'some other info'],
			['name2', 'city2', 'more info']
		];
		let csvContent = `data:text/csv;charset=utf-8,Licencia,Fecha de creacion,Estado\n 
			${rows.map(e => e.join(',')).join('\n')}`;
		var encodedUri = encodeURI(csvContent);
		var link = document.createElement('a');
		link.setAttribute('href', encodedUri);
		link.setAttribute('download', 'licencias.csv');
		link.style.visibility = 'hidden';
		document.body.appendChild(link);
		link.click();
		document.body.removeChild(link);
	}

	function solicitarLicencias(formData) {
		if (formData.licencias > 0) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'licencias/createMultipleLicence',
				data: formData,
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
							html: `<span class='white-text'>Proceso completo</span>`
						});
						//window.location.href = 'http://localhost/pruebas/test/PACT/';
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
		} else {
			M.toast({ html: 'Numero de Licencias Inválido' });
		}
	}

	$('#btn-cancelar').on('click', function(e) {
		e.preventDefault();
		document.getElementById('input-busqueda').value = '';
		divBusqueda.style.display = '';
		divResultados.style.display = 'none';
	});

	$('#licencia-form').submit(function(event) {
		event.preventDefault();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'licencias/sendLicencia',
			data: $('#licencia-form').serialize(), // serializes the form's elements.
			success: function(data) {
				console.table(data);
				if (data.error) {
					console.error(data.mensaje);
					M.toast({
						html: `<span class='red-text'>${data.mensaje}</span>`
					});
				} else {
					console.log(data.msg);
					M.toast({
						html: `<span class='white-text'>${data.mensaje}</span>`
					});
					$('#licencia-form').trigger('reset');
					//window.location.href = '/';
				}
			},
			error: function(error) {
				console.error(`ERROR JS: ${error}`);
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
