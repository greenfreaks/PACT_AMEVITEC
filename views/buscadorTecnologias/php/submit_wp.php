    <?php
    include "conexion.php";
        $idusuario_general = $_GET["idusuario_general"];
        $message = "<h5>Esta institución aún no ha registrado laboratorios<h5>";
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Somos la Agencia Mexicana de Vinculación Tecnológica, una asociación civil sin fines de lucro dedicada a promover, gestionar y capacitar la vinculación entre empresas y universidades.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PACT</title>

        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <link rel="stylesheet" href="../../../public/css/style.css">
        <link rel="stylesheet" href="../../../public/css/talentos.css">

        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

        <title>
        </title>
    </head>
    <body>

    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper container">
                <a class="brand-logo center">Talentos</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>

        <div class="content_container">
            <section id="" class="formulario_wp">

            <?php
                $query = mysqli_query($connection, "SELECT * FROM perfil_academico pa
                    INNER JOIN usuario_general ug ON pa.usuario_general_idusuario_general = ug.idusuario_general
                    INNER JOIN grado_academico ga ON pa.grado_academico_idgrado_academico = ga.idgrado_academico
                    INNER JOIN organizacion org ON pa.organizacion_actual = org.idorganizacion
                    INNER JOIN funcion_academico fa ON pa.funcion_academico_idfuncion_academico = fa.idfuncion_academico
                    INNER JOIN subdisciplina sub ON pa.subdisciplina_idsubdisciplina = sub.idsubdisciplina
                    INNER JOIN disciplina dis ON sub.disciplina_iddisciplina = dis.iddisciplina
                    INNER JOIN campo_conocimiento camp ON dis.campo_conocimiento_idcampo_conocimiento = camp.idcampo_conocimiento
                    INNER JOIN perfil_academico_has_actividad_experiencia exp ON exp.perfil_academico_idperfil_academico
                    WHERE idusuario_general = '$idusuario_general' LIMIT 1;
                    
                    ");

                $result = mysqli_num_rows($query);

                if($result > 0){
                    while($data = mysqli_fetch_array($query)){
            ?>

            <section class="parrafos center card">
                <h6 class="texto-blanco negritas title">Estás solicitando información del talento que tiene los siguientes datos:</h6>
                <h6 class="texto-azul negritas">1. Grado académico:</h6>
                <p><?php echo $data["grado_academico"]?></p>

                <h6 class="texto-azul negritas">2. Título Obtenido:</h6>
                <p><?php echo $data["titulo_obtenido"]?></p>

                <h6 class="texto-azul negritas">3. Escuela:</h6>
                <p><?php echo $data["escuela"]?></p>

                <h6 class="texto-azul negritas">4. Organización:</h6>
                <p><?php echo $data["organizacion"]?></p>

                <h6 class="texto-azul negritas">5. Función académica</h6>
                <p><?php echo $data["funcion_academico"]?></p>

                <h6 class="texto-azul negritas">6. Campo del conocimiento</h6>
                <p><?php echo $data["campo_conocimiento"]?></p>

                <h6 class="texto-azul negritas">7. Disciplina</h6>
                <p><?php echo $data["disciplina"]?></p>
                <h6 class="texto-azul negritas">8. Subdisciplina</h6>
                <p><?php echo $data["subdisciplina"]?></p>

            </section>

            <section class="center btns">
                <a href="../" id="submit_wp" class="btn">Enviar mensaje de WhatsApp</a>
                <a class="btn" href="../">Regresar</a>
            </section>

            <section class="inputs">
                <input id="id" value="<?php echo $data["idusuario_general"]?>"> <br>
                <input id="grado" value="<?php echo $data["grado_academico"]?>"> <br>
                <input id="titulo" value="<?php echo $data["titulo_obtenido"]?>"> <br>
                <input id="escuela" value="<?php echo $data["escuela"]?>"> <br>
                <input id="organizacion" value="<?php echo $data["organizacion"]?>"> <br>
                <input id="funcion" value="<?php echo $data["funcion_academico"]?>"> <br>
                <input id="campo" value="<?php echo $data["campo_conocimiento"]?>"> <br>
                <input id="disciplina" value="<?php echo $data["disciplina"]?>"> <br>
                <input id="subdisciplina" value="<?php echo $data["subdisciplina"]?>"> <br>
            </section>

            <?php
                    }
                }
            ?>
        </div>
        <script src = "../js/msj_wp.js"></script>

    </body>
</html>