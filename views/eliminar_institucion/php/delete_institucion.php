<?php 

include("public/php/conexion.php");
// error_reporting(E_ERROR);

/*---------------------------------------------------------------------------------------------------------------------------*/
/*--------------------------------------ENVÍO DE DATOS CONTACTO--------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------------------------------------------*/
if(isset($_POST['delete_institucion'])){
    $id_institucion = trim($_POST['id_institucion']);
    $password = ($_POST['password']);
    $consult_password = "SELECT * FROM uci_instituciones WHERE id_institucion = '$id_institucion' AND password = '$password'";
    $check_password = mysqli_query($connection, $consult_password);
    $nrp = mysqli_num_rows($check_password);
    if($nrp == 1){
        $query_delete_institucion = "DELETE FROM uci_instituciones WHERE id_institucion = '$id_institucion'"; 
        
        $enviar_delete_institucion = mysqli_query($connection, $query_delete_institucion);
        if($enviar_delete_institucion){?>
            <script type="text/javascript">
                Swal.fire({
                    icon: 'success',
                    showConfirmButton: false,
                    title: '¡Institución eliminada correctamente!',
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
                text: 'No ha sido eliminar el laboratorio'
                // footer: '<a href="">Why do I have this issue?</a>'
            });
            </script>
    <?php
    }
}
       