$(document).ready(function() {
	$('#login-form').submit(function(e) {
		e.preventDefault();
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: 'login/login',
			data: $('#login-form').serialize(), // serializes the form's elements.
			success: function(data) {
				console.table(data);
				if (data.error) {
					console.error(data.message);
					M.toast({
						html: `<span class="red-text">${data.message}</span>`
					});
				} else {
					console.log(data.msg);
					M.toast({
						html: `<span class="white-text">Proceso completo</span>`
					});
					$('#login-form').trigger('reset');
					window.location.href = '/PACT-AMEVITEC/';
					//window.location.href = "localhost/PACT";
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
});
