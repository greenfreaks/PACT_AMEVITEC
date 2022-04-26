$(document).ready(function(){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'directorio_ies/getInstituciones',
        success: function(data){
            if(data.error){
                console.error(data.message);
                M.toast({
                    html: `<span>${data.message}</span>`
                });
            }else{
                console.log(data.message);
                $('#listadoUnisCis').html(
                    `<h1>Hello</h1>`
                );
            }
        },
        beforeSend: function() {
			console.log('Inicio de envio de datos.');
			console.group();
		},
		complete: function() {
			console.groupEnd();
			console.log('Fin de envio de datos.');
		}
    });
});