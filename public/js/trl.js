let aux;

$(document).ready(function() {
	let data_saved = false;
	let formData = {};
	formData['startTime'] = new Date()
		.toISOString()
		.slice(0, 19)
		.replace('T', ' ');

	window.onbeforeunload = function() {
		if (!data_saved) {
			console.error('datos sin guardar');
			return 'Datos sin guardar ¿Estás seguro que desea salir?';
		} else {
			return;
		}
	};

	let stepper_TRL = new MStepper(document.querySelector('#preguntas_trl'), {
		// options
		firstActive: 0
	});

	let glosario_item = concept => {
		return `<li class="collection-item"><strong>${concept.concepto}: </strong><p>${concept.definicion}</p></li>`;
	};

	let pregunta_item = pregunta => {
		return `<li class="collection-item"><label><input onclick="ts(this)" name="preguntas" type="checkbox" value="${pregunta.id}"/><span>${pregunta.pregunta}</span></label></li>`;
	};

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'trl/getPreguntas',
		success: function(data) {
			//console.table(data);
			if (data.error) {
				console.error(data.message);
				M.toast({
					html: `<span class='red-text'>${data.message}</span>`
				});
			} else {
				let steps = data.preguntas_TRL.map(categoria => {
					return `
                    <li class='step'>
                        <div class='step-title waves-effect'>
                            <div class="hide-on-med-and-up">
                            ${categoria.categoria}
                            </div>
                        </div>
                        <div class='step-content'>
                            <div id="glosario${categoria.categoria}" 
                            class="modal modal-fixed-footer">
                                <div class="modal-content">
                                    <h4 class = "texto-marino" >Glosario de sección 
                                    ${categoria.categoria}</h4>
                                    <ul class="collection">
                                    ${categoria.glosario
																																					.map(glosario_item)
																																					.join('')}
                                    </ul>
                                </div>
                                <div class="modal-footer">
                                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                                </div>
                            </div>
                            <!-- Your step content goes here (like inputs or so) -->
                            <h5>Sección: ${categoria.categoria}</h5>
                            <p>${categoria.descripcion}</p>
                            <a class="waves-effect waves-light btn modal-trigger" 
                            href="#glosario${categoria.categoria}">Glosario</a>
                            <ul class="collection">
                                ${categoria.preguntas
																																	.map(pregunta_item)
																																	.join('')}
                            </ul>
                            <!-- Here goes your actions buttons -->
                                <button class='waves-effect waves-dark btn-flat previous-step'>Atras</button>
                                <button class='waves-effect waves-dark btn next-step'>Siguiente</button>
							<!-- <div class='step-actions'></div> -->
                        </div>
                    </li>`;
				});
				var addedSteps = stepper_TRL.activateStep(steps, 1);
				$('.modal').modal();
			}
		},
		error: function(e) {
			console.error(`ERROR JS: ${e}`);
			M.toast({
				html:
					'⚠ Ocurrio un error al Cargar las preguntas, por favor recargala paáina e intenteade nuevo ⚠'
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

	$('#trl-form').submit(function(e) {
		e.preventDefault();

		formData['checkedItems'] = [
			...document.querySelectorAll('input[type=checkbox][name=preguntas]')
		]
			.filter(check => {
				return check.indeterminate || check.checked;
			})
			.map(check => {
				return check.value;
			});
		formData['answers'] = [...formData['checkedItems']].join(',');
		formData['finishTime'] = new Date()
			.toISOString()
			.slice(0, 19)
			.replace('T', ' ');

		if (formData['checkedItems'].length > 5) {
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: 'trl/setEval',
				data: formData, // serializes the form's elements.
				success: function(data) {
					console.table(data);
					if (data.error) {
						console.error(data.message);
						M.toast({
							html: `<span class='red-text'>${data.message}</span>`
						});
					} else {
						$('#btn-submit').attr('disabled', true);
						console.log(data.msg);
						data_saved = true;
						M.toast({
							html: `<span class='white-text'>Proceso completo... redirigiendo</span>`,
							displayLength: 1000,
							completeCallback: function() {
								console.info(
									'Redirigiendo technology/verproyecto/' + data.idTecnologia
								);
								window.location.href = 'technology/verproyecto/' + data.idTecnologia;
							}
						});
					}
				},
				error: function(e) {
					console.error(`ERROR JS: ${e}`);
					M.toast({
						html:
							'⚠ Ocurrio un error al enviar sts respuestas, por favor recarga la paáina e intenta de nuevo ⚠'
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
			M.toast({
				html:
					'<p class="red-text">Numero de Respuestas insuficientes. Verifica tus respuestas</p>'
			});
		}
	});
});

function shuffle(a) {
	var j, x, i;
	for (i = a.length - 1; i > 0; i--) {
		j = Math.floor(Math.random() * (i + 1));
		x = a[i];
		a[i] = a[j];
		a[j] = x;
	}
	return a;
}
