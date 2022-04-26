$(document).ready(function() {
	//===================================================================
	//=================== Inicializar
	//===================================================================

	$('#registro_plataforma-academico').hide();
	$('#registro_plataforma-empresario').hide();
	$('#registro_completado').hide();
	$('#recomendaciones_academico').hide();
	$('#recomendaciones_empresario').hide();

	$('#btn-registro_academico').on('click', function() {
		$('#registro_plataforma-academico').show('slow');
		$('#rol_selector').hide();
		$('#recomendaciones_academico').show();
	});
	$('#btn-registro_empresario').on('click', function() {
		$('#registro_plataforma-empresario').show('slow');
		$('#rol_selector').hide();
		$('#recomendaciones_empresario').show();
	});

	//===================================================================
	//=============== Registro Empresarios
	//===================================================================

	let stepper_empresas = new MStepper(
		document.querySelector('#stepper-empresas'),
		{
			// options
			firstActive: 0, // this is the default
			validationFunction: empresasValidationFunction
		}
	);

	function empresasValidationFunction(stepperForm, activeStepContent) {
		let pass = $('#registro_empresario-form-input-pass').val();
		let pass2 = $('#registro_empresario-form-input-pass2').val();

		if (pass != pass2) {
			M.toast({
				html: `<span class="red-text">Las contraseñas deben coincidir</span>`
			});
			return false;
		}

		let inputs = activeStepContent.querySelectorAll('input, textarea, select');
		for (let i = 0; i < inputs.length; i++)
			if (!inputs[i].checkValidity()) {
				setTimeout(function() {
					M.toast({
						html: `<span class="red-text">Verifique los campos obligatorios</span>`
					});
					$('#registro_empresario-form')
						.find('#registro_empresario-form-btn-submit')
						.click();
					//inputs[i].focus();
				}, 50);
				return false;
			}
		return true;
	}

	//===================================================================
	//=============== Registro Academicos
	//===================================================================

	let stepper_academia = new MStepper(
		document.querySelector('#stepper-academia'),
		{
			// options
			firstActive: 0, // this is the default
			validationFunction: academiaValidationFunction
		}
	);

	function academiaValidationFunction(stepperForm, activeStepContent) {
		let pass = $('#registro_academico-form-input-pass').val();
		let pass2 = $('#registro_academico-form-input-pass2').val();

		if (pass != pass2) {
			M.toast({
				html: `<span class="red-text">Las contraseñas deben coincidir</span>`
			});
			return false;
		}

		let inputs = activeStepContent.querySelectorAll('input, textarea, select');
		for (let i = 0; i < inputs.length; i++)
			if (!inputs[i].checkValidity()) {
				setTimeout(function() {
					M.toast({
						html: `<span class="red-text">Verifique los campos obligatorios</span>`
					});
					$('#registro_academia-form')
						.find('#registro_academico-form-btn-submit')
						.click();
					//inputs[i].focus();
				}, 50);
				return false;
			}
		return true;
	}

	$('#registro_academia-form').submit(function(e) {
		e.preventDefault();
		// this.checkValidity();
		// let formData = objectifyForm($("#registro-form").serializeArray());

		let formData = $('#registro_academia-form :input')
			.filter(function(index, element) {
				return $(element).val() != '';
			})
			.serialize();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'registro/registroAcademico',
			data: formData, // serializes the form's elements.
			success: function(data) {
				if (data.error) {
					console.error(data.message);

					M.toast({
						html: `<span class="red-text">${data.message}, verifique el formulario</span>`
					});
				} else {
					console.log(data.message);

					M.toast({
						html: `<span class="white-text">Registro completo</span>`
					});
					$('#registro_plataforma-form').trigger('reset');

					$('#registro_plataforma-academico').hide();
					$('#registro_completado').show('slow');
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
	});

	$('select').change(function() {
		if ($(this).prop('multiple')) {
			if ($(this).data('max')) {
				if ($(this).val().length > $(this).data('max')) {
					M.toast({
						html: `<span class="red-text">Se recomienda un máximo de ${$(this).data(
							'max'
						)} opciones</span>`
					});
					$(this)
						.val($(this).data('last_valid_selection'))
						.formSelect();
				} else {
					$(this).data('last_valid_selection', $(this).val());
				}
			}
		}
	});

	$('input[type=checkbox][class=habilidades_experiencia]').on('change', function(
		e
	) {
		if (
			$('input[type=checkbox][class=habilidades_experiencia]:checked').length > 3
		) {
			$(this).prop('checked', false);
			M.toast({
				html: `<span class="red-text">Seleccionar un máximo de 3 opciones</span>`
			});
		}
	});

	$('input[type=checkbox][class=habilidades]').on('change', function(e) {
		if ($('input[type=checkbox][class=habilidades]:checked').length > 3) {
			$(this).prop('checked', false);
			M.toast({
				html: `<span class="red-text">Seleccionar un máximo de 3 habilidades</span>`
			});
		}
	});

	$('input[type=checkbox][class=competencias]').on('change', function(e) {
		if ($('input[type=checkbox][class=competencias]:checked').length > 3) {
			$(this).prop('checked', false);
			M.toast({
				html: `<span class="red-text">Seleccionar un máximo de 3 competencias</span>`
			});
		}
	});

	$('#registro_academico-form-input-fecha_egreso').attr('disabled', true);

	$('#registro_academico-form-input-actualmente_estudiando').on(
		'change',
		function() {
			if (this.value == 1) {
				$('#registro_academico-form-input-fecha_egreso').attr('disabled', true);
			} else {
				$('#registro_academico-form-input-fecha_egreso').attr('disabled', false);
			}
		}
	);

	//===================================================================
	//=============== 1. Estados y municipios - ACADEMICO
	//===================================================================

	let ubicacion;
	$.getJSON('api/getMunicipios', function(data) {
		ubicacion = data;
		//se vacia el campo de select
		$('#registro_academico-form-input-estado')
			.children()
			.remove();
		//se agrega una opcion deshabilitada como placeholder
		$('#registro_academico-form-input-estado').append(
			$('<option>', {
				text: 'Seleccione Estado',
				disabled: true,
				selected: true
			})
		);

		$('#registro_empresario-form-input-estado')
			.children()
			.remove();

		$('#registro_empresario-form-input-estado').append(
			$('<option>', {
				text: 'Seleccione Estado',
				disabled: true,
				selected: true
			})
		);

		for (let estado of ubicacion.estados) {
			$('#registro_academico-form-input-estado').append(
				$('<option>', {
					value: estado.id,
					text: estado.nombre
				})
			);

			$('#registro_empresario-form-input-estado').append(
				$('<option>', {
					value: estado.id,
					text: estado.nombre
				})
			);
		}

		$('#registro_academico-form-input-estado').formSelect();
		$('#registro_empresario-form-input-estado').formSelect();
	});

	$('#registro_academico-form-input-estado').on('change', function() {
		let estado = ubicacion.estados.find(item => item.id == this.value);

		$('#registro_academico-form-input-municipio')
			.children()
			.remove();

		$('#registro_academico-form-input-municipio').append(
			$('<option>', {
				text: 'Seleccione Municipio',
				disabled: true,
				selected: true
			})
		);

		for (let municipio of estado.municipios) {
			$('#registro_academico-form-input-municipio').append(
				$('<option>', {
					value: municipio.id,
					text: municipio.nombre
				})
			);
		}

		$('#registro_academico-form-input-municipio').formSelect();
	});

	$('#registro_empresario-form-input-estado').on('change', function() {
		let estado = ubicacion.estados.find(item => item.id == this.value);

		$('#registro_empresario-form-input-municipio')
			.children()
			.remove();

		$('#registro_empresario-form-input-municipio').append(
			$('<option>', {
				text: 'Seleccione Municipio',
				disabled: true,
				selected: true
			})
		);

		for (let municipio of estado.municipios) {
			$('#registro_empresario-form-input-municipio').append(
				$('<option>', {
					value: municipio.id,
					text: municipio.nombre
				})
			);
		}

		$('#registro_empresario-form-input-municipio').formSelect();
	});

	//===================================================================
	//=============== 2. Campo de conocimiento
	//===================================================================

	let campos;

	$.getJSON('api/getDisciplinas', function(data) {
		campos = data;

		$('#campo_de_conocimiento')
			.children()
			.remove();
		$('#campo_de_conocimiento').append(
			$('<option>', {
				text: 'Seleccione Campo',
				disabled: true,
				selected: true
			})
		);

		for (let campo of campos.campos) {
			$('#campo_de_conocimiento').append(
				$('<option>', {
					value: campo.id,
					text: campo.campo
				})
			);
			$('#campo_de_conocimiento').formSelect();
		}
	});

	let selected_campo;
	$('#campo_de_conocimiento').on('change', function() {
		//alert( this.value );
		$('#div-disciplina').hide();
		$('#div-subdisciplina').hide();
		selected_campo = campos.campos.find(item => item.id == this.value);

		$('#disciplina')
			.children()
			.remove();
		$('#disciplina').append(
			$('<option>', {
				text: 'Seleccione Disciplina',
				disabled: true,
				selected: true
			})
		);
		for (let disciplina of selected_campo.disciplinas) {
			$('#disciplina').append(
				$('<option>', {
					value: disciplina.id,
					text: disciplina.disciplina
				})
			);
			$('#disciplina').formSelect();
		}
		$('#div-disciplina').show('slow');
	});

	let selected_disciplina;
	$('#disciplina').on('change', function() {
		//alert( this.value );
		$('#div-subdisciplina').hide();
		$('#step2').addClass('disabled');
		selected_disciplina = selected_campo.disciplinas.find(
			item => item.id == this.value
		);

		$('#subdisciplina')
			.children()
			.remove();
		$('#subdisciplina').append(
			$('<option>', {
				text: 'Seleccione Disciplina',
				disabled: true,
				selected: true
			})
		);
		for (let subdisciplina of selected_disciplina.subdisciplinas) {
			$('#subdisciplina').append(
				$('<option>', {
					value: subdisciplina.id,
					text: subdisciplina.subdisciplina
				})
			);
			$('#subdisciplina').formSelect();
		}
		$('#div-subdisciplina').show('slow');
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

	$('#registro_empresario-form').submit(function(e) {
		e.preventDefault();
		// this.checkValidity();
		// let formData = objectifyForm($("#registro-form").serializeArray());

		let formData = $('#registro_empresario-form :input')
			.filter(function(index, element) {
				return $(element).val() != '';
			})
			.serialize();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'registro/registroEmpresario',
			data: formData, // serializes the form's elements.
			success: function(data) {
				if (data.error) {
					console.error(data.message);

					M.toast({
						html: `<span class="red-text">${data.message}, verifique el formulario</span>`
					});
				} else {
					console.log(data.message);

					M.toast({
						html: `<span class="white-text">Registro completo</span>`
					});
					$('#registro_empresario-form').trigger('reset');

					$('#registro_empresario-form').hide();
					$('#registro_completado').show('slow');
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
	});

	//fin document ready
});
