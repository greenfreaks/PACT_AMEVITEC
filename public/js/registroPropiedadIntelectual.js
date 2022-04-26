$(document).ready(function () {
    // window.onbeforeunload = function () {
    //     if (!data_saved) {
    //         console.error('datos sin guardar');
    //         return 'Datos sin guardar ¿Estás seguro que desea salir?';
    //     } else {
    //         return;
    //     }
    // }

    // LLenar Select de sectores Industriales
    let sectores;
    $.getJSON('registroPropiedadIntelectual/getSectores', function (data) {
        sectores = data;

        $('#form__registroPropiedad--sectoresPropiedad').append(
            $('<option>', {
                text: 'Puedes elegir más de uno',
                disabled: true,
                selected: true
            })
        );
        for (let sec of sectores.sectoresIndustriales) {
            $('#form__registroPropiedad--sectoresPropiedad').append(
                $('<option>', {
                    value: sec.idsector_scian,
                    text: sec.sector_scian
                })
            );
            $('#form__registroPropiedad--sectoresPropiedad').formSelect();
        }

    });

    // LLenar Select de tipos de Propiedad Intelectual
    let tipoPropiedad;
    $.getJSON('registroPropiedadIntelectual/getTipoPropiedadController', function (data) {
        tipoPropiedad = data;

        $('#form__registroPropiedad--tipoPropiedad').append(
            $('<option>', {
                text: 'Elige un tipo de Propiedad Intelectual',
                disabled: true,
                selected: true
            })
        );
        for (let tPropiedad of tipoPropiedad.tipoPropiedad) {
            $('#form__registroPropiedad--tipoPropiedad').append(
                $('<option>', {
                    value: tPropiedad.id_tipoPropiedadIntelectual,
                    text: tPropiedad.nombre_tipoPropiedadIntelectual
                })
            );
            $('#form__registroPropiedad--tipoPropiedad').formSelect();
        }

    }); // End Function

    // LLenar Select de Estatus de Propiedad Intelectual
    let tipoEstatusPropiedad;
    $.getJSON('registroPropiedadIntelectual/getEstatusPropiedadController', function (data) {
        tipoEstatusPropiedad = data;

        $('#form__registroPropiedad--estatusPropiedad').append(
            $('<option>', {
                text: 'Elige el estatus de tu Propiedad Intelectual',
                disabled: true,
                selected: true
            })
        );
        for (let tipoEstatusP of tipoEstatusPropiedad.tipoEstatusPropiedad) {
            $('#form__registroPropiedad--estatusPropiedad').append(
                $('<option>', {
                    value: tipoEstatusP.id_estatus,
                    text: tipoEstatusP.nombre_estatus
                })
            );
            $('#form__registroPropiedad--estatusPropiedad').formSelect();
        }

    }); // End Function

    //Llenar Select de Regiones de la Propiedad Intelectual
    let regionDeLaPropiedad;
    $.getJSON('registroPropiedadIntelectual/getRegionesPropiedadController', function (data){
        regionDeLaPropiedad = data;
        $('#form__registroPropiedad--regionPropiedad').append(
            $('<option>', {
                text: 'Selecciona la región de tu protección',
                disabled: true,
                selected: true
            })
        );
        for(let regProp of regionDeLaPropiedad.regionPropiedad){
            $('#form__registroPropiedad--regionPropiedad').append(
                $('<option>', {
                    value: regProp.id,
                    text: regProp.nombre
                })
            );
            $('#form__registroPropiedad--regionPropiedad').formSelect();
        }
    }); // END FUNCTION

    //Se obtienen los datos del formulario

    $('#form__registroPropiedad').on('submit', function (e) {
        e.preventDefault();

        $('#form__registroPropiedad--submit').attr('disabled', true);
        let formdata = {};
        formdata['titularPropiedad'] = $('#form__registroPropiedad--titularPropiedad').val();
        formdata['inventoresPropiedad'] = $('#form__registroPropiedad--inventoresPropiedad').val();
        formdata['resumenPropiedad'] = $('#form__registroPropiedad--resumenPropiedad').val();
        formdata['tipoPropiedad'] = $('#form__registroPropiedad--tipoPropiedad').val();
        formdata['tituloPropiedad'] = $('#form__registroPropiedad--tituloPropiedad').val();

        formdata['sectoresPropiedad'] = [];
        $('input[type=checkbox][name=sectoresPropiedad]:checked').each(function () {
            formdata['sectorePropiedad'].push($(this).attr('value'));
        });

        formdata['estatusPropiedad'] = $('#form__registroPropiedad--estatusPropiedad').val();
        formdata['regionPropiedad'] = $('#form__registroPropiedad--regionPropiedad').val();
        formdata['numeroPatentePropiedad'] = $('#form__registroPropiedad--numeroPatentePropiedad').val();
        formdata['linkPropiedad'] = $('#form__registroPropiedad--linkPropiedad').val();

        console.log(formdata);

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'registroPropiedadIntelectual/registrarPropiedadController',
            data: formdata,
            success: function (data) {
                if (data.error == true) {
                    console.error(data.mensaje);
                    M.toast({
                        html: `<span class='red-text'>error: ${data.mensaje}</span>`
                    });
                    $('#form__registroPropiedad--submit').attr('disabled', false);
                } else {
                    data_saved = true;
                    console.log(data.msg);
                    $('#form__registroPropiedad').trigger('reset');
                    M.toast({
                        html: '¡Datos Insertados de forma Correcta!',
                        completeCallback: function () {
                            console.error('Your toast was dismissed');
                            $('#form__registroPropiedad--submit').attr('disabled', false);
                            //window.location.href = '/';
                        }
                    });
                }
            },
            error: function(e){
                console.error(`ERROR JS: ${e}`);
                M.toast({
                    html:
						'⚠ Ocurrio un error al enviar sus datos, por favor recargue la pagina e intente de nuevo ⚠',
					completeCallback: function() {
						console.error('Your toast was dismissed');
						$('#form__registroPropiedad--submit').attr('disabled', false);
						//window.location.href = '/';
					}
                });
            },
            beforeSend: function(){
                console.log('Inicio de envío de datos');
                console.group();
            },
            complete: function(){
                console.groupEnd();
                console.log('Fin de envio de datos');
            }
        });
    });
});