<?php
include "public/php/conexion.php";
$id_institucion = $_GET["id_institucion"];
$query = mysqli_query($connection, "SELECT * FROM uci_instituciones ins
INNER JOIN uci_tipo_institucion tipo ON ins.tipo_institucion = tipo.id_tipo_institucion
INNER JOIN estado est ON ins.estado = est.idestado
WHERE id_institucion = '$id_institucion'"
);
$result = mysqli_num_rows($query);
if($result > 0){
    while($data = mysqli_fetch_array($query)){?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.0.0/dist/css/mstepper.min.css">
    <link rel="stylesheet" href="public/css/style.css">

    <!-- ALERTIFY JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    
    <!-- SWEET ALERT -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMEVITEC - Beneficios para academia </title>
</head>
<body>
    <div class="navbar-fixed">
        <?php include "views/header.php";?>
    </div>
    <div class="content_container">
        <h5>Eliminar institución</h5>
        <h5>Estás por eliminar la institución: <b><?php echo $data['nombre_institucion']?></b></h5>
        <h6 class="negritas">Es muy importante que tengas en cuenta que si eliminas esta institución, también se eliminarán 
            todos sus laboratorios y líneas de investigación.</h6>
        <div class="divider"></div>

        <h6>1. ID de la institución.</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data['id_institucion']?></h6> <br>

        <h6>2. Tipo de institución</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data['tipo_institucion']?></h6> <br>

        <h6>3. Página Web</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data['webpage']?></h6> <br>

        <h6>4. Entidad federativa.</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["estado"]?></h6><br>

        <h6>5. Titular de la rectoría</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["tit_rectoria"]?></h6> <br>

        <h6>6. Email del/la titular de la rectoría</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["email_rectoria"]?></h6> <br>

        <h6>7. Titular del área de vinculación</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["tit_vinculacion"]?></h6> <br>

        <h6>8. Email del/la titular del área de vinculación</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["email_vinculacion"]?></h6> <br>

        <h6>9. Titular del área académica</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["tit_academia"]?></h6> <br>

        <h6>10. Email del/la titular del área académica</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["email_academia"]?></h6> <br>

        <h6>11. Código institucional</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["password"]?></h6> <br>

        


        <form method="POST" id="form_delete_institucion">
        <div>
            <select name="id_institucion" id="" class="browser-default" >
                <option value="<?php echo $data["id_institucion"];?>"><?php echo $data["nombre_institucion"];?></option>
                <?php include "public/php/llenado_instituciones.php";?>
            </select>

            <h6>1. Nombre de la institución.</h6>
            <input class="laboratorio" name="laboratorio" value="<?php echo $data["nombre_institucion"]?>" required> <br>
            <p>
                <label>
                    <input class="privacidad" name="privacidad" value="" type="checkbox"/>
                    <span>He leído y aceptado los términos del <a href="http://www.amevitec.org/sections/privacidad.html" target="_blank" class="texto-azul">aviso de privacidad</a></span>
                </label>
            </p>
            </div>

            <div class="password center">
                <h6 class="texto-azul">Introduce el código que te proporcionó tu Coordinador del Inventario. (Puedes copiarlo y pegarlo)</h6>
                <input type="password" class="password" name="password" placeholder="Introduce aquí la clave institucional" required class="center bold">
            </div> <br>

            <div class="submit center">
                <input type="submit" value="Eliminar" class="btn red darken-3 delete_lab" name="delete_institucion" onclick="return ConfirmSubmit()">
                <a href="index" class="btn">Regresar</a>
            </div>

            <?php include "php/delete_institucion.php"?>
        </form>
        <?php
    }
}
?>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://unpkg.com/materialize-stepper@3.0.0/dist/js/mstepper.min.js"></script>
    <script src="../../js/init.js"></script>
    <script type="text/javascript">
        function ConfirmSubmit()
        {
            var respuesta = confirm("¿Estás seguro de querer enviar tus datos? Da clic en ACEPTAR para continuar o en CANCELAR para verificar tu información.");
            if (respuesta == true) 
            {
                return true;
            }else{
                return false
            }
        }
    </script>
    <script src="public/js/evitar_reenvio.js"></script>
</body>
</html>

