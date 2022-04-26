<?php
include "public/php/conexion.php";
$id_lab = $_GET["id_lab"];
$query = mysqli_query($connection, "SELECT * FROM uci_labs ul 
INNER JOIN uci_instituciones ui ON ul.fk_institucion = ui.id_institucion
INNER JOIN estado est ON ui.estado = est.idestado
INNER JOIN uci_ambito am ON ul.fk_ambito = am.id_ambito
INNER JOIN uci_areas_conocimiento uac ON ul.fk_area_conocimiento = uac.id_area_conocimiento
WHERE id_lab = '$id_lab'");
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
        <nav>
            <div class="nav-wrapper container">
                <a class="brand-logo center">Eliminar Laboratorio</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
    <div class="content_container">
        <h4><?php echo $data["nombre_institucion"];?></h4>
        <h5>Estas por eliminar el laboratorio o línea de investigación con la siguiente información:</h5>
        <div class="divider"></div>

        <h6>1. Nombre de tu laboratorio o línea de investigación.</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data['laboratorio']?></h6> <br>

        <h6>2. ¿Qué equipamiento tiene tu laboratorio? <b>o en caso de ser una línea de investigación</b> ¿Qué tipo de datos o información genera el proyecto o línea de investigación?</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data['equipo']?></h6> <br>

        <h6>3. ¿Qué servicios a la industria brinda tu laboratorio? <b>o en caso de ser una línea de investigación</b> ¿A qué industrias puede dar servicio con el proyecto o línea de investigación?</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["servicio"]?></h6><br>

        <h6>4. Nombre completo del responsable del laboratorio o línea de investigación.</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["nombre_responsable"]?></h6><br>

        <h6>5. Correo de contacto del responsable del laboratorio o línea de investigación.</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["email_responsable"]?></h6> <br>

        <h6>6. Teléfono de contacto del responsable del laboratorio o línea de investigación.</h6>
        <h6 style="color: var(--marino);" class="negritas"><?php echo $data["telefono_responsable"]?></h6> <br>


        <form method="POST" id="form_update_lab" id="form_delete_lab">
        <div class="hide" style="display: none;">
            <select name="id_institucion" id="" class="browser-default" >
                <option value="<?php echo $data["id_institucion"];?>"><?php echo $data["nombre_institucion"];?></option>
                <?php include "public/php/llenado_instituciones.php";?>
            </select>

            <h6>1. Nombre de tu laboratorio o proyecto.</h6>
            <input class="laboratorio" name="laboratorio" value="<?php echo $data["laboratorio"]?>" required> <br>

            <h6>2. ¿Qué equipamiento tiene tu laboratorio? <b>o en caso de ser una línea de investigación</b> ¿Qué tipo de datos o información genera el proyecto o línea de investigación?</h6>
            <textarea style="min-height: 100px;" class="equipo" name="equipo"><?php echo $data["equipo"]?></textarea required><br>

            <h6>3. ¿Qué servicios a la industria brinda tu laboratorio? <b>o en caso de ser un proyecto</b> ¿A qué industrias puede dar servicio con el proyecto o línea de investigación?</h6>
            <textarea style="min-height: 100px;" class="servicio" name="servicio"><?php echo $data["servicio"]?></textarea required><br>

            <h6>4. Nombre completo del responsable del laboratorio o proyecto.</h6>
            <input class="nombre_responsable" name="nombre_responsable" value="<?php echo $data["nombre_responsable"]?>" required> <br>

            <h6>5. Correo de contacto del responsable del laboratorio o proyecto.</h6>
            <input class="emial_responsable" name="email_responsable" value="<?php echo $data["email_responsable"]?>" required> <br>

            <h6>6. Teléfono de contacto del responsable del laboratorio o proyecto.</h6>
            <input class="telefono_responsable" name="telefono_responsable" value="<?php echo $data["telefono_responsable"]?>" required> <br>

            <p>
                <label>
                    <input class="privacidad" name="privacidad" value="" type="checkbox"/>
                    <span>He leído y aceptado los términos del <a href="http://www.amevitec.org/sections/privacidad.html" target="_blank" class="texto-azul">aviso de privacidad</a></span>
                </label>
            </p>
            </div>

            <div class="password center">
                <h6 class="texto-azul">Introduce el código que te proporcionó tu Coordinador del Inventario.</h6>
                <input type="password" class="password" name="password" placeholder="Introduce aquí tu clave institucional" required class="center bold">
            </div> <br>

            <div class="submit center">
                <input type="submit" value="Eliminar" class="btn red darken-3 delete_lab" name="delete_lab" onclick="return ConfirmSubmit()">
                <a href="index" class="btn">Regresar</a>
            </div>

            <?php include "php/delete_lab.php"?>
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

