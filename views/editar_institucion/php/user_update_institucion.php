<?php 
#error_reporting(E_ERROR);

/*---------------------------------------------------------------------------------------------------------------------------*/
/*--------------------------------------ENVÍO DE DATOS CONTACTO--------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------------------------------------------*/
if(isset($_POST['update'])){
        // $tipo_institucion = ($_POST['tipo_institucion']);
        $id_institucion = ($_POST['institucion']);
        $entidad = ($_POST['entidad']);

        $webpage = ($_POST['webpage']);
        $tit_rectoria = ($_POST['tit_rectoria']);
        $email_rectoria = ($_POST['email_rectoria']);
        $tit_vinculacion = ($_POST['tit_vinculacion']);
        $email_vinculacion = ($_POST['email_vinculacion']);
        $tit_academia = ($_POST['tit_academia']);
        $email_academia = ($_POST['email_academia']);
        $areas_oferta_educativa = ($_POST['areas_oferta_educativa']);
        $areas_educacion_continua = ($_POST['areas_educacion_continua']);
        $password = ($_POST['password']);
        $privacidad = ($_POST['privacidad']);

        $consult_password = "SELECT * FROM uci_instituciones WHERE id_institucion = '$id_institucion' AND password = '$password'";
        $check_password = mysqli_query($connection, $consult_password);
        $nrp = mysqli_num_rows($check_password);

        
        if($nrp == 1){
            $query_registro = "UPDATE uci_instituciones 
            SET  estado = '$entidad', webpage = '$webpage',
            tit_rectoria = '$tit_rectoria', email_rectoria = '$email_rectoria',
            tit_vinculacion = '$tit_vinculacion', email_vinculacion = '$email_vinculacion',
            tit_academia = '$tit_academia', email_academia = '$email_academia'
            WHERE id_institucion = '$id_institucion'";

            $enviar_registro = mysqli_query($connection, $query_registro);

            $query_delete_oferta_e = "DELETE FROM uci_areas_oferta_educativa_as_institucion WHERE fk_id_institucion = '$id_institucion'";
            $enviar_delete_oferta_e = mysqli_query($connection, $query_delete_oferta_e);

            $query_delete_educacion_c = "DELETE FROM uci_areas_educacion_continua_as_institucion WHERE fk_id_institucion = '$id_institucion'";
            $enviar_delete_educacion_c = mysqli_query($connection, $query_delete_educacion_c);

            foreach($areas_oferta_educativa as $oferta_educativa){
                $query_oferta_educativa = "INSERT INTO uci_areas_oferta_educativa_as_institucion(fk_id_institucion, fk_id_area_oferta)
                                        VALUES('$id_institucion', '$oferta_educativa')";
                $enviar_oferta_educativa = mysqli_query($connection, $query_oferta_educativa);
            }

            foreach($areas_educacion_continua as $educacion_continua){
                $query_educacion_continua = "INSERT INTO uci_areas_educacion_continua_as_institucion(fk_id_institucion, fk_id_areas_educacion_continua)
                                            VALUES('$id_institucion', '$educacion_continua')";
                $enviar_educacion_continua = mysqli_query($connection, $query_educacion_continua);
            }
    
            if($enviar_registro AND $enviar_oferta_educativa AND $enviar_educacion_continua AND $enviar_delete_oferta_e AND $enviar_delete_educacion_c){?>
                <script type="text/javascript">
                    Swal.fire({
                        icon: 'success',
                        showConfirmButton: false,
                        title: 'Datos actualizados correctamente!',
                        allowOutsideClick: false,
                        footer: '<a class="btn blue darken-3" href="directorio_ies">Ok</a>',
                    });
                </script>
            <?php
            }else{?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salió mal'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                </script>
            <?php
            }
        }else{?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '¡Contraseña incorrecta!',
                    text: 'No ha sido posible enviar sus datos'
                    // footer: '<a href="">Why do I have this issue?</a>'
                });
            </script>
        <?php
        }
    }
    


  
                



