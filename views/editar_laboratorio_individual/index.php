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
                <a class="brand-logo center">Editar datos del laboratorio</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
    <div class="content_container">
        <h4><?php echo $data["nombre_institucion"];?></h4>
        <h6 class="texto-marino negritas"><?php echo $data["laboratorio"];?></h6> <br>
        <form method="POST" id="form_update_lab" id="form_update_lab">
            <select name="id_institucion" id="" class="browser-default" style="display: none;" >
                <option value="<?php echo $data["id_institucion"];?>"><?php echo $data["nombre_institucion"];?></option>
                <?php include "public/php/llenado_instituciones.php";?>
            </select>

            <h6>1. Nombre de tu laboratorio o línea de investigación.</h6>
            <input class="laboratorio" name="laboratorio" value="<?php echo $data["laboratorio"]?>" required> <br>

            <h6>2. ¿Qué equipamiento tiene tu laboratorio? <b>o en caso de ser una línea de investigación</b> ¿Qué tipo de datos o información genera?</h6>
            <textarea style="min-height: 100px;" class="equipo" name="equipo"><?php echo $data["equipo"]?></textarea required><br>

            <h6>3. ¿Qué servicios a la industria brinda tu laboratorio? <b>o en caso de ser una línea de investigación</b> ¿A qué industrias puede dar servicio?</h6>
            <textarea style="min-height: 100px;" class="servicio" name="servicio"><?php echo $data["servicio"]?></textarea required><br>

            <h6>4. Nombre completo del responsable del laboratorio o línea de investigación.</h6>
            <input class="nombre_responsable" name="nombre_responsable" value="<?php echo $data["nombre_responsable"]?>" required> <br>

            <h6>5. Correo de contacto del responsable del laboratorio o línea de investigación.</h6>
            <input class="emial_responsable" name="email_responsable" value="<?php echo $data["email_responsable"]?>" required> <br>

            <h6>6. Teléfono de contacto del responsable del laboratorio o línea de investigación.</h6>
            <input class="telefono_responsable" name="telefono_responsable" value="<?php echo $data["telefono_responsable"]?>" required> <br>

            <p>
                <label>
                    <input class="privacidad" name="privacidad" value="" type="checkbox" required />
                    <span>He leído y acepto los términos del <a href="http://www.amevitec.org/sections/privacidad.html" target="_blank" class="texto-azul">aviso de privacidad</a></span>
                </label>
            </p>

            <div class="password center">
                <h6 class="texto-azul">Introduce el código que te proporcionó tu Coordinador del Inventario.</h6>
                <input type="password" class="password" name="password" placeholder="Introduce aquí tu clave institucional" required class="center bold">
            </div> <br>

            <div class="submit center">
                <input type="submit" value="Actualizar" class="btn yellow darken-3 update_lab" name="update_lab">
                <a href="directorio_ies" class="btn">Regresar</a>
            </div>

            <?php include "php/update_lab.php"?>
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
    <script>
        $(function(){
            var laboratorio, equipo, servicio, nombre_responsable, email_responsable, telefono_responsable;
            $(".update_lab").on('click', function(){
                laboratorio = $(".laboratorio").val();
                equipo = $(".equipo").val();
                servicio = $(".servicio").val();
                nombre_responsable = $(".nombre_responsable").val();
                email_responsable = $(".email_responsable").val();
                telefono_responsable = $(".telefono_responsable").val();

                if(laboratorio == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el nombre del laboratorio'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                if(equipo == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el equipamiento especializado del laboratorio o línea de investigación'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false; 
                }
                if(servicio == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe los servicios a la industria que puede ofrecer tu laboratorio o línea de investigación'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false; 
                }
                if(nombre_responsable == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el nombre completo del responsable del laboratrio o línea de investigación'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false; 
                }
                if(email_responsabñe == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el mail de contacto del responsable del laboratrio o línea de investigación'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false; 
                }
                if(telefono_responsable == ""){
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe teléfono o contacto del responsable del laboratrio o línea de investigación'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false; 
                }
            });
        });

        
    </script>

    <script src="public/js/evitar_reenvio.js"></script>
</body>
</html>

