<?php 

include("public/php/conexion.php");
error_reporting(E_ERROR);

/*---------------------------------------------------------------------------------------------------------------------------*/
/*--------------------------------------ENVÍO DE DATOS CONTACTO--------------------------------------------------------------*/
/*---------------------------------------------------------------------------------------------------------------------------*/
if(isset($_POST['delete_lab'])){
    $id_institucion = trim($_POST['id_institucion']);
    $laboratorio = trim($_POST['laboratorio']);
    $equipo = trim($_POST['equipo']);
    $servicio = ($_POST['servicio']);
    $nombre_responsable = ($_POST['nombre_responsable']);
    $email_responsable = ($_POST['email_responsable']);
    $telefono_responsable = ($_POST['telefono_responsable']);
    $password = ($_POST['password']);
    $consult_password = "SELECT * FROM uci_instituciones WHERE id_institucion = '$id_institucion' AND password = '$password'";
    $check_password = mysqli_query($connection, $consult_password);
    $nrp = mysqli_num_rows($check_password);
    if($nrp == 1){
        $query_delete_lab = "DELETE FROM uci_labs WHERE id_lab = '$id_lab'"; 
        
        $enviar_delete_lab = mysqli_query($connection, $query_delete_lab);
        if($enviar_delete_lab){?>
            <script type="text/javascript">
                Swal.fire({
                    icon: 'success',
                    showConfirmButton: false,
                    title: '¡Laboratorio eliminado correctamente!',
                    allowOutsideClick: false,
                    footer: '<a class="btn blue darken-3" href="individual_lab?lab_id= <?php echo $id_institucion?>">Ok</a>',
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
       