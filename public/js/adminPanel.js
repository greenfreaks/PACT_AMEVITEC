$(document).ready(function() {
	console.log('document ready');
	//Insert code here

	//colores de fondo para las gráficas
	let chartBgColors = [
		'rgba(255, 99, 132, 0.6)',
		'rgba(54, 162, 235, 0.6)',
		'rgba(255, 206, 86, 0.6)',
		'rgba(75, 192, 192, 0.6)',
		'rgba(153, 102, 255, 0.6)',
		'rgba(255, 99, 132, 0.6)',
		'rgba(54, 162, 235, 0.6)',
		'rgba(255, 206, 86, 0.6)',
		'rgba(75, 192, 192, 0.6)',
		'rgba(153, 102, 255, 0.6)',
		'rgba(255, 159, 64, 0.6)'
	];

	let chartBorderColors = [
		'rgba(255, 99, 132, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(255, 206, 86, 1)',
		'rgba(75, 192, 192, 1)',
		'rgba(153, 102, 255, 1)',
		'rgba(255, 99, 132, 1)',
		'rgba(54, 162, 235, 1)',
		'rgba(255, 206, 86, 1)',
		'rgba(75, 192, 192, 1)',
		'rgba(153, 102, 255, 1)',
		'rgba(255, 159, 64, 1)'
	];

	//var ctx = document.getElementById('usuarios').getContext('2d');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'adminpanel/getChartsData',
		success: function(data) {
			if (data.error) {
				console.error(data.mensaje);
				M.toast({
					html: `<span class='red-text'>${data.msg}</span>`
				});
			} else {
				data.charts.forEach(chart => {
					$('#charts').append(
						`<div class="col l6 m6 s12 white center">
                            <h5>${chart.title}</h5>
                            <canvas id=${chart.id}></canvas>
                        </div>`
					);
					var myPieChart = new Chart($(`#${chart.id}`), {
						type: chart.type,
						data: {
							datasets: [
								{
									label: chart.title,
									data: chart.data.map(data => {
										return data.value;
									}),
									backgroundColor: chartBgColors,
									borderColor: chartBorderColors
								}
							],
							labels: chart.data.map(data => {
								return data.label;
							})
						},
						options: {}
					});
				});

				//window.location.href = 'http://localhost/pruebas/test/PACT/';
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
