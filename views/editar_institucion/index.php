<?php
    include "public/php/conexion.php";
    $id_institucion = $_GET["id_institucion"];
    // -------------------------Obtener checkbox de las áreas de oferta educativa---------------------
    $last_areas = array( );
    $query_areas_oferta = "SELECT * FROM uci_areas_oferta_educativa_as_institucion WHERE fk_id_institucion = '$id_institucion'";
    $result_areas_oferta = mysqli_query($connection, $query_areas_oferta);

    // Obtener checkbox seleccionados de las áreas de oferta educativa
    
    while($chkd_areas = mysqli_fetch_assoc( $result_areas_oferta )){
        $last_areas[] = $chkd_areas['fk_id_area_oferta'];
    }
    // var_dump($last_areas);

    $query_areas_oferta = "SELECT * FROM uci_areas_oferta_educativa";
    $result_areas_oferta = mysqli_query($connection, $query_areas_oferta);

     // -------------------------Obtener checkbox de las áreas de oferta educativa---------------------
    $last_educacion_continua = array( );
    $query_educacion_continua = "SELECT * FROM uci_areas_educacion_continua_as_institucion WHERE fk_id_institucion = '$id_institucion'";
    $result_educacion_continua= mysqli_query($connection, $query_educacion_continua);

    // Obtener checkbox seleccionados de las áreas de educación continua
    while($chkd_educacion_continua = mysqli_fetch_assoc($result_educacion_continua)){
        $last_educacion_continua[] = $chkd_educacion_continua['fk_id_areas_educacion_continua'];
    }
    // var_dump($last_educacion_continua);

    $query_educacion_continua = "SELECT * FROM uci_areas_educacion_continua";
    $result_educacion_continua = mysqli_query($connection, $query_educacion_continua);


    //CONSULTA
    $query = mysqli_query($connection, "SELECT * FROM uci_instituciones ui 
    INNER JOIN uci_tipo_institucion t ON ui.tipo_institucion = t.id_tipo_institucion
    INNER JOIN estado e ON ui.estado = e.idestado
    WHERE id_institucion = '$id_institucion'
    ");
    $result = mysqli_num_rows($query);

    if($result > 0){
        while($data = mysqli_fetch_array($query)){
    ?>
<!doctype html>
<html>

<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <link rel="stylesheet" href="https://unpkg.com/materialize-stepper@3.0.0/dist/css/mstepper.min.css">
    <link rel="stylesheet" href="public/css/style.css">

    <!-- ALERTIFY JS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />

    <!-- SWEET ALERT -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMEVITEC - Beneficios para academia </title>
</head>

<body>


    <?php require 'views/include_views/templates/header.php'; ?>
    <div class="content_container">
        <h5 class="center">Editar datos de la institución</h5>
        <!------------ FORMULARIO UPDATE INSTITUCIÓN PARA EL USUARIO--------------------- -->
        <?php if ($_SESSION['userType'] == 1 || $_SESSION['userType'] == 2) :?>
        <form name="form_update" method="POST" id="update_form">
            <h4><?php echo $data["nombre_institucion"]?></h4>
            <!-- <h6>1. Tipo de institución.</h6>
        <div class="input-field col s12">
            <select name="tipo_institucion">
                <option value="0" disabled selected required>Selecciona un tipo de institución</option>
                <option value="1">Universidad</option>
                <option value="1">Centro de investigación</option>            
            </select>
        </div> -->

            <div style="display: none">
                <h6>2. Nombre de la institución.</h6>
                <div class="input-field col s12">
                    <select name="institucion" class="browser-default" required>
                        <option value="<?php echo $data["id_institucion"]?>"><?php echo $data["nombre_institucion"]?>
                        </option>
                        <?php include "public/php/llenado_instituciones.php";?>
                    </select>
                </div>
            </div>


            <h6>1. Entidad federativa.</h6>
            <div class="input-field col s12">
                <select name="entidad" class="browser-default entidad" required>
                    <option value="<?php echo $data["idestado"]?>"><?php echo $data["estado"]?></option>
                    <?php include "public/php/llenado_estado.php";?>
                </select>
            </div>

            <h6>2. Página web.</h6>
            <input type="text" class="webpage" name="webpage" value="<?php echo $data["webpage"]?>" required>


            <h6>3. Nombre del titular de la rectoría o presidencia.</h6>
            <input type="text" class="tit_rectoria" name="tit_rectoria" value="<?php echo $data["tit_rectoria"]?>"
                required>

            <h6>4. Correo de contacto de la rectoría.</h6>
            <input type="email" class="email_rectoria" name="email_rectoria"
                value="<?php echo $data["email_rectoria"]?>" required>

            <h6>5. Nombre del titular del área de vinculación.</h6>
            <input type="text" class="tit_vinculacion" name="tit_vinculacion"
                value="<?php echo $data["tit_vinculacion"]?>" required>

            <h6>6. Correo de contacto del área de vinculación.</h6>
            <input type="email" class="email_vinculacion" name="email_vinculacion"
                value="<?php echo $data["email_vinculacion"]?>" required>

            <h6>7. Nombre del titular del área académica.</h6>
            <input type="text" class="tit_academia" name="tit_academia" value="<?php echo $data["tit_academia"]?>"
                required>

            <h6>8. Correo de contacto del área académica.</h6>
            <input type="email" class="email_academia" name="email_academia"
                value="<?php echo $data["email_academia"]?>" required>

            <h6>9. Áreas de oferta educativa.</h6>
            <?php
        while($fila_areas_oferta = mysqli_fetch_assoc($result_areas_oferta)){
            $checked_areas = ( in_array( $fila_areas_oferta['id_area_oferta'], $last_areas )) ? 'checked' : '';
            echo "<p>
		            <label>
			            <input $checked_areas type='checkbox' class='oferta_educativa' name='areas_oferta_educativa[]' value='".$fila_areas_oferta['id_area_oferta']."'/>
			            <span>".$fila_areas_oferta['nombre_area_oferta']."</span>
		            </label>
	            </p>";
        }
        ?>

            <h6>10. Áreas de educación continua.</h6>
            <?php
        while($fila_educacion_continua = mysqli_fetch_assoc($result_educacion_continua)){
            $checked_educacion_continua = ( in_array( $fila_educacion_continua['id_area_educacion_continua'], $last_educacion_continua )) ? 'checked' : '';
            echo "<p>
		            <label>
			            <input $checked_educacion_continua type='checkbox' class='areas_educacion_continua' name='areas_educacion_continua[]' value='".$fila_educacion_continua['id_area_educacion_continua']."'/>
			            <span>".$fila_educacion_continua['nombre_area_educacion_continua']."</span>
		            </label>
	            </p>";
        }
        ?>

            <div class="divider"></div>

            <div>
                <p>
                    <label>
                        <input type="checkbox" class=privacidad"" name="privacidad" required value="1" />
                        <span><b>He leído y acepto los términos del <a href="../privacidad.html">aviso de
                                    privacidad</a></b></h6></span>
                    </label>
                </p>
            </div>

            <div class="password center">
                <h6 class="texto-azul">Introduce tu Clave Institucional.</h6>
                <input type="password" class="password" name="password"
                    placeholder="Introduce aquí tu clave institucional" required class="browser-default center bold"
                    required>
            </div> <br>

            <div class="submit center">
                <input type="submit" value="Enviar" class="btn yellow darken-3 update" name="update">
                <a href="directorio_ies" class="btn">Regresar</a>
            </div>
            <?php include "php/user_update_institucion.php";?>
        </form>

        <?php endif;
    if ($_SESSION['userType'] == 3) :?>
        <form name="form_update" method="POST" id="update_form">
            <h4><?php echo $data["nombre_institucion"]?></h4>
            <!-- <h6>1. Tipo de institución.</h6>
        <div class="input-field col s12">
            <select name="tipo_institucion">
                <option value="0" disabled selected required>Selecciona un tipo de institución</option>
                <option value="1">Universidad</option>
                <option value="1">Centro de investigación</option>            
            </select>
        </div> -->

            <div style="display: none">
                <h6>2. Nombre de la institución.</h6>
                <div class="input-field col s12">
                    <select name="institucion" class="browser-default" required>
                        <option value="<?php echo $data["id_institucion"]?>"><?php echo $data["nombre_institucion"]?>
                        </option>
                        <?php include "public/php/llenado_instituciones.php";?>
                    </select>
                </div>
            </div>


            <h6>1. Entidad federativa.</h6>
            <div class="input-field col s12">
                <select name="entidad" class="browser-default entidad" required>
                    <option value="<?php echo $data["idestado"]?>"><?php echo $data["estado"]?></option>
                    <?php include "public/php/llenado_estado.php";?>
                </select>
            </div>

            <h6>2. Página web.</h6>
            <input type="text" class="webpage" name="webpage" value="<?php echo $data["webpage"]?>" required>


            <h6>3. Nombre del titular de la rectoría o presidencia.</h6>
            <input type="text" class="tit_rectoria" name="tit_rectoria" value="<?php echo $data["tit_rectoria"]?>"
                required>

            <h6>4. Correo de contacto de la rectoría.</h6>
            <input type="email" class="email_rectoria" name="email_rectoria"
                value="<?php echo $data["email_rectoria"]?>" required>

            <h6>5. Nombre del titular del área de vinculación.</h6>
            <input type="text" class="tit_vinculacion" name="tit_vinculacion"
                value="<?php echo $data["tit_vinculacion"]?>" required>

            <h6>6. Correo de contacto del área de vinculación.</h6>
            <input type="email" class="email_vinculacion" name="email_vinculacion"
                value="<?php echo $data["email_vinculacion"]?>" required>

            <h6>7. Nombre del titular del área académica.</h6>
            <input type="text" class="tit_academia" name="tit_academia" value="<?php echo $data["tit_academia"]?>"
                required>

            <h6>8. Correo de contacto del área académica.</h6>
            <input type="email" class="email_academia" name="email_academia"
                value="<?php echo $data["email_academia"]?>" required>

            <h6>9. Áreas de oferta educativa.</h6>
            <?php
        while($fila_areas_oferta = mysqli_fetch_assoc($result_areas_oferta)){
            $checked_areas = ( in_array( $fila_areas_oferta['id_area_oferta'], $last_areas )) ? 'checked' : '';
            echo "<p>
		            <label>
			            <input $checked_areas type='checkbox' class='oferta_educativa' name='areas_oferta_educativa[]' value='".$fila_areas_oferta['id_area_oferta']."'/>
			            <span>".$fila_areas_oferta['nombre_area_oferta']."</span>
		            </label>
	            </p>";
        }
        ?>

            <h6>10. Áreas de educación continua.</h6>
            <?php
        while($fila_educacion_continua = mysqli_fetch_assoc($result_educacion_continua)){
            $checked_educacion_continua = ( in_array( $fila_educacion_continua['id_area_educacion_continua'], $last_educacion_continua )) ? 'checked' : '';
            echo "<p>
		            <label>
			            <input $checked_educacion_continua type='checkbox' class='areas_educacion_continua' name='areas_educacion_continua[]' value='".$fila_educacion_continua['id_area_educacion_continua']."'/>
			            <span>".$fila_educacion_continua['nombre_area_educacion_continua']."</span>
		            </label>
	            </p>";
        }
        ?>
            <div class="divider"></div>

            <h6>11. Clave Institucional actual.</h6>
            <p class=" texto-marino negritas"><?php echo $data["password"]?></p>
            <p>Si deseas cambiar la Clave Institucional, modifícala en este campo. </p>
            <input type="text" class="ch_psw" name="ch_psw" value="<?php echo $data["password"]?>" required>

            <div class="divider"></div>

            <!-- <div>
            <p>
                <label>
                    <input type="checkbox" class=privacidad"" name="privacidad" required value = "1"/>
                     <span><b>He leído y acepto los términos del <a href="../privacidad.html">aviso de privacidad</a></b></h6></span>
                </label>
            </p>
        </div> -->

            <div class="password center">
                <h6 class="texto-azul">Introduce tu Clave Institucional.</h6>
                <input type="password" class="password" name="password"
                    placeholder="Introduce aquí tu clave institucional" required class="browser-default center bold"
                    required>
            </div> <br>

            <div class="submit center">
                <input type="submit" value="Enviar" class="btn yellow darken-3 update" name="update">
                <a href="directorio_ies" class="btn">Regresar</a>
            </div>
            <?php include "php/admin_update_institucion.php";?>
        </form>
        <?php endif;
    }
}
    ?>


    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://unpkg.com/materialize-stepper@3.0.0/dist/js/mstepper.min.js"></script>
    <script src="../../js/init.js"></script>
    <!-- <script type="text/javascript">
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
    </script> -->

    <script>
        $(function () {
            var entidad, webpage, tit_rectoria, email_rectoria, tit_vinculacion, email_vinculacion,
                tit_academia, email_academia, areas_oferta_educativa, areas_educacion_continua;
            $(".update").on('click', function () {
                entidad = $(".entidad").val();
                webpage = $(".webpage").val();
                tit_rectoria = $(".tit_rectoria").val();
                email_rectoria = $(".email_rectoria").val();
                tit_vinculacion = $(".tit_vinculacion").val();
                email_vinculacion = $(".email_vinculacion").val();
                tit_academia = $(".tit_academia").val();
                email_academia = $(".email_academia").val();
                oferta_educativa = document.getElementById("update_form").checkbox;
                var cont = 0;

                if (entidad == 33) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Seleccione una entidad'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                if (webpage == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe la página web de la institución'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                if (tit_rectoria == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el nombre del titular de la rectoría'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                if (email_rectoria == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el email de contacto de la rectoría'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                if (tit_vinculacion == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el nombre del titular del área de vinculación'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                if (email_vinculacion == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el email de contacto del área de vinculación'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                if (tit_academia == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el nombre del titular del área académica'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                if (email_academia == "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campos Vacíos',
                        text: 'Escribe el email de contacto del área académica'
                        // footer: '<a href="">Why do I have this issue?</a>'
                    });
                    return false;
                }
                for (var x = 0; x < oferta_educativa.length; x++) {
                    if (oferta_educativa[x].checked) {
                        cont = cont + 1;
                    }
                }
                alert("checkboxes = " + cont)
            });
        });
    </script>

    <script src="public/js/evitar_reenvio.js"></script>



    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137988434-2"></script>

</body>

</html>