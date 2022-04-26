$(document).ready(function(){
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: 'registroPropiedadIntelectual/getSectores',
        success: function(data){
            if(data.error){
                console.error(data.message);
                M.toast({
                    html: `<span class = 'red-text'>${data.message}</span>`
                });
            }else{
                $('#holiwis').append(`
                <h2>Holiwis</h2>`);
            }
        },
        beforeSend: function(){
            console.log('Inicio de envío de datos');
            console.group();
        },
        complete: function(){
            console.groupEnd();
            console.log('Fin de envío de datos');
        }
    });
    M.AutoInit();
});//End Document