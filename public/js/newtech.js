let data_saved = false;
$(document).ready(function() {
	window.onbeforeunload = function() {
		if (!data_saved) {
			console.error('datos sin guardar');
			return 'Datos sin guardar ¿Esta seguro que desea salir?';
		} else {
			return;
		}
	};

	let stepper_newtech = new MStepper( 
		document.querySelector('#stepper-newtech'),
		{
			// options
			firstActive: 0
		}
	);

	$('#btn-next-beneficios').attr('diabled', true);

	$('input[type=checkbox][name=problematica]').on('change', function(e) {
		if ($('input[type=checkbox][name=problematica]:checked').length > 2) {
			$(this).prop('checked', false);
			M.toast({
				html: `<span class="red-text">Seleccionar un máximo de 2 opciones</span>`
			});
		}
		if ($('input[type=checkbox][name=problematica]:checked').length < 1) {
			$('#btn-next-beneficios').attr('diabled', true);
		} else {
			$('#btn-next-beneficios').attr('diabled', false);
		}
	});

	//===================================================================
	//=============== 2. Sectores Industriales
	//===================================================================

	let sectores;
	$.getJSON('api/getSectores', function(data) {
		sectores = data;

		$('#sector_scian')
			.children()
			.remove();

		$('#sector_scian').append(
			$('<option>', {
				text: 'Seleccione Sector',
				disabled: true,
				selected: true
			})
		);

		for (let sector of sectores.sectores) {
			$('#sector_scian').append(
				$('<option>', {
					value: sector.id,
					text: sector.sector
				})
			);
		}

		$('#sector_scian').formSelect();
	});

	let sector;
	$('#sector_scian').on('change', function() {
		//alert( this.value );
		sector = sectores.sectores.find(item => item.id == this.value);
		$('#subsector_scian')
			.children()
			.remove();
		$('#subsector_scian').append(
			$('<option>', {
				text: 'Seleccione Subsector',
				disabled: true,
				selected: true
			})
		);

		$('#rama_scian')
			.children()
			.remove();
		$('#rama_scian').append(
			$('<option>', {
				text: 'Seleccione Rama',
				disabled: true,
				selected: true
			})
		);

		for (let subsector of sector.subsectores) {
			$('#subsector_scian').append(
				$('<option>', {
					value: subsector.id,
					text: subsector.subsector
				})
			);
		}

		$('#subsector_scian').formSelect();
	});

	let subsector;
	$('#subsector_scian').on('change', function() {
		//alert( this.value );
		subsector = sector.subsectores.find(item => item.id == this.value);
		$('#rama_scian')
			.children()
			.remove();
		$('#rama_scian').append(
			$('<option>', {
				text: 'Seleccione Rama',
				disabled: true,
				selected: true
			})
		);
		for (let rama of subsector.ramas) {
			$('#rama_scian').append(
				$('<option>', {
					value: rama.id,
					text: rama.rama
				})
			);
		}
		$('#rama_scian').formSelect();
	});

	//============= Sector industrial
	$('#next-btn-sectores').attr('disabled', true);
	let table_sector = [];
	//agrega sector seleccionado al arreglo table_sector
	$('#btn-seleccionar-rama').on('click', function(e) {
		e.preventDefault();
		if (
			!$('#sector_scian').val() ||
			!$('#subsector_scian').val() ||
			!$('#rama_scian').val()
		) {
			M.toast({ html: 'Debe seleccionar sector, subsector y rama' });
		} else {
			let auxSelected = {
				idsector: $('#sector_scian').val(),
				sector: sectores.sectores.find(item => item.id == $('#sector_scian').val())
					.sector,
				idsubsector: $('#subsector_scian').val(),
				subsector: sector.subsectores.find(
					item => item.id == $('#subsector_scian').val()
				).subsector,
				idrama: $('#rama_scian').val(),
				rama: subsector.ramas.find(item => item.id == $('#rama_scian').val()).rama
			};
			table_sector.push(auxSelected);
			fill_table(table_sector);
		}
	});

	let fill_table = table_array => {
		let auxstring = ``;

		for (var [key, item] of table_array.entries()) {
			auxstring += `<tr>
        <td>${item.sector}</td>
        <td>${item.subsector}</td>
        <td>${item.rama}</td>
        <td><a data-elem="${key}" class="btn-floating btn-small waves-effect waves-light red btn-del_sector"><i class="material-icons">delete_forever</i></a></td>
    </tr>`;
		}

		$('#div-selected_sectores').html(
			`<table class="centered striped responsive-table">
				<thead class="white-text">
					<tr>
						<th>Sector</th>
						<th>Subsector</th>
						<th>Rama</th>
						<th>Quitar</th>
					</tr>
				</thead>
				<tbody>
					${auxstring}
				</tbody>
			</table>`
		);
		let botones = document.querySelectorAll('.btn-del_sector');
		for (let boton of botones) {
			boton.onclick = function(e) {
				//console.log(this.dataset.elem);
				table_sector.splice(this.dataset.elem, 1);
				fill_table(table_sector);
			};
		}

		if (table_sector.length < 1) {
			$('#next-btn-sectores').attr('disabled', true);
		} else {
			$('#next-btn-sectores').attr('disabled', false);
		}

		if (table_sector.length > 2) {
			$('#btn-seleccionar-rama').attr('disabled', true);
		} else {
			$('#btn-seleccionar-rama').attr('disabled', false);
		}

		$('#sector_scian')
			.prop('selectedIndex', 0)
			.change();
	};

	//============= Caracterizacion de tecnologia

	let catalogos;
	$.getJSON('newtech/getCatalogosPredicados', function(data) {
		catalogos = data;
		$('#sel_tecnologia')
			.children()
			.remove();
		$('#sel_tecnologia').append(
			$('<option>', {
				text: 'Tipo de Tecnología',
				disabled: true,
				selected: true
			})
		);
		for (let tipo_tecnologia of catalogos.tipo_tecnologia) {
			$('#sel_tecnologia').append(
				$('<option>', {
					value: tipo_tecnologia.id,
					text: tipo_tecnologia.val
				})
			);
		}
		$('#sel_tecnologia').formSelect();

		$('#sel_usuario')
			.children()
			.remove();
		$('#sel_usuario').append(
			$('<option>', {
				text: 'Seleccione',
				disabled: true,
				selected: true
			})
		);
		for (let tipo_tecnologia of catalogos.tiposUsuarios) {
			$('#sel_usuario').append(
				$('<option>', {
					value: tipo_tecnologia.id,
					text: tipo_tecnologia.val
				})
			);
		}
		$('#sel_usuario').formSelect();

		$('#sel_verbo')
			.children()
			.remove();
		$('#sel_verbo').append(
			$('<option>', {
				text: 'Seleccione un verbo',
				disabled: true,
				selected: true
			})
		);
		for (let verbo of catalogos.verbos) {
			$('#sel_verbo').append(
				$('<option>', {
					value: verbo.id,
					text: verbo.val
				})
			);
		}
		$('#sel_verbo').formSelect();
	});

	$('#next-btn-predicados').attr('disabled', true);

	let predicados = [];
	$('#btn-agregar-predicado').on('click', function(e) {
		e.preventDefault();
		if (
			!$('#sel_tecnologia').val() ||
			!$('#sel_usuario').val() ||
			!$('#sel_verbo').val() ||
			$('#input-complemeto').val() == ''
		) {
			M.toast({ html: '<span>Debe de construir una frase completa.</span>' });
		} else {
			let auxPredicado = {
				idtecnologia: $('#sel_tecnologia').val(),
				textotecnologia: $('#sel_tecnologia option:selected').text(),
				idusuario: $('#sel_usuario').val(),
				textousuario: $('#sel_usuario option:selected').text(),
				idverbo: $('#sel_verbo').val(),
				textoverbo: $('#sel_verbo option:selected').text(),
				complemento: $('#input-complemeto').val()
			};

			predicados.push(auxPredicado);
			fill_predicados(predicados);
		}
	});

	let fill_predicados = table_array => {
		let auxstring = ``;
		for (var [key, item] of table_array.entries()) {
			auxstring += `<tr>
        <td> Mi(s) ${item.textotecnologia} va(n) dirigido(s) a ${item.textousuario} y ${item.textoverbo} ${item.complemento}</td>
        <td><a data-elem="${key}" class="btn-floating btn-small waves-effect waves-light red btn-del_predicado"><i class="material-icons">delete_forever</i></a></td>
      </tr>`;
		}
		$('#div-predicados').html(`
    <table class="centered striped responsive-table">
        <thead class="white-text">
          <tr>
              <th>Caracteristica</th>
              <th>Quitar</th>
          </tr>
        </thead>
        <tbody>
          ${auxstring}
        </tbody>
    </table>`);
		let botones = document.querySelectorAll('.btn-del_predicado');
		for (let boton of botones) {
			boton.onclick = function(e) {
				predicados.splice(this.dataset.elem, 1);
				fill_predicados(predicados);
			};
		}

		if (predicados.length < 1) {
			$('#next-btn-predicados').attr('disabled', true);
		} else {
			$('#next-btn-predicados').attr('disabled', false);
		}

		if (predicados.length > 4) {
			$('#btn-agregar-predicado').attr('disabled', true);
		} else {
			$('#btn-agregar-predicado').attr('disabled', false);
		}

		$('#sel_tecnologia').prop('selectedIndex', 0);
		$('#sel_usuario').prop('selectedIndex', 0);
		$('#sel_verbo').prop('selectedIndex', 0);
		$('#input-complemeto').val('');
	};

	//================= Objetivos ONU
	$.getJSON('newtech/getObjetivosONU', function(data) {
		if (!data.error) {
			objetives = data.objetivos;
			let auxString = ``;
			for (let objetivo of data.objetivos) {
				auxString += `
			  <div class="col l4 s12 celda valign-wrapper">
				<p class="center-align">
					<label>
						<input type="checkbox" name="objetivosONU" class="filled-in objetivo" value="${objetivo.id}" />
						<span class="white-text"><img class="responsive-img" src="public/img/ONU/${objetivo.id}.png" alt="${objetivo.objetivo}"> </span> 
					</label>
				</p>
              </div>`;
			}
			$('#div-objetivos').html(auxString);

			$('input[type=checkbox][name=objetivosONU]').on('change', function(e) {
				if ($('input[type=checkbox][name=objetivosONU]:checked').length > 3) {
					$(this).prop('checked', false);
					M.toast({
						html: `<span class="red-text">Seleccionar un máximo de 3 opciones</span>`
					});
				}
			});
		} else {
			console.error('error: ' + data.msg);
			M.toast({
				html:
					'<span class="red-text">⚠ ERROR al recibir sus datos, por favor recargue la pagina e intente de nuevo </span>'
			});
		}
	});

	$('#form-newtech').on('submit', function(e) {
		e.preventDefault();

		$('#btn-submit-tech').attr('disabled', true);
		let formdata = {};
		formdata['techname'] = $('#input-techname').val();
		formdata['problematica'] = [];
		$('input[type=checkbox][name=problematica]:checked').each(function() {
			formdata['problematica'].push($(this).attr('val'));
		});

		formdata['alianza'] = $('input[type=radio][name=alianza]:checked').attr(
			'val'
		);
		formdata['sectores'] = table_sector;
		formdata['predicados'] = predicados;

		formdata['objetivos'] = [];
		$('input[type=checkbox][name=objetivosONU]:checked').each(function() {
			formdata['objetivos'].push($(this).attr('value'));
		});

		console.log(formdata);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'newtech/setTech',
			data: formdata, // serializes the form's elements.
			success: function(data) {
				//console.table(data);
				if (data.error) {
					console.error(data.mensaje);
					M.toast({
						html: `<span class='red-text'>error: ${data.mensaje}</span>`
					});
					$('#btn-submit-tech').attr('disabled', false);
				} else {
					data_saved = true;
					console.log(data.msg);
					$('#form-newtech').trigger('reset');
					table_sector = [];
					predicados = [];
					M.toast({
						html: `<span class='white-text'>Registro de proyecto completado</span>`,
						displayLength: 2000,
						completeCallback: function() {
							console.info('Redirigiendo technology/verproyecto/' + data.idTecnologia);
							window.location.href = 'technology/verproyecto/' + data.idTecnologia;
						}
					});
				}
			},
			error: function(e) {
				console.error(`ERROR JS: ${e}`);
				M.toast({
					html:
						'⚠ Ocurrio un error al enviar sus datos, por favor recargue la pagina e intente de nuevo ⚠',
					completeCallback: function() {
						console.error('Your toast was dismissed');
						$('#btn-submit-tech').attr('disabled', false);
						//window.location.href = '/';
					}
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

	//============= FIN Document Ready
});
