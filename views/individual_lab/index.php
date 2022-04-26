<?php
        include "public/php/conexion.php";
        $lab_id = $_GET['lab_id'];
        error_reporting(E_ERROR);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Somos la Agencia Mexicana de Vinculación Tecnológica, una asociación civil sin fines de lucro dedicada a promover, gestionar y capacitar la vinculación entre empresas y universidades.">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PACT</title>
            <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        <link rel="stylesheet" href="public/css/materialize.css">
        <link rel="stylesheet" href="public/css/style.css">
        <link rel="stylesheet" href="public/css/table_labs.css">


       <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <title>
        </title>
    </head>
    <body>

    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper container">
                <a class="brand-logo center">Inventario de Laboratorios y Proyectos</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
        <?php require 'views/sidenav.php'; ?>

        <div class="section wrapper">
            <div class="content_container">
            
            <section id="labsCiencias">
                <?php 

                //CONSULTA
                    $query_name = mysqli_query($connection, "SELECT * FROM uci_labs ul 
                    INNER JOIN uci_instituciones ui ON ul.fk_institucion = ui.id_institucion
                    WHERE ul.fk_institucion = '$lab_id' LIMIT 1");

                    $result_name = mysqli_num_rows($query_name);

                    if($result_name > 0){
                        while ($data = mysqli_fetch_array($query_name)){
                ?>
                        <h6 class="negritas"> Institución: </h6 class="negritas">
                        <h6 class="texto-azul negritas"><?php echo $data["nombre_institucion"]?></h6>

                <?php
                    }
                }
                ?>
                </section>
                        
            <section id="labsIng" class="lab_table table_container">
                     <table class="table sticky" id="">
                        <thead>
                            <tr class="tr">
                                <th style = "min-width: 400px;" class="center">Institución</th>
                                <th class="center">Entidad</th>
                                <th class="center">Ámbito</th>
                                <th style = "min-width: 300px;" class="center">Área del conocimiento</th>
                                <th style = "min-width: 300px;" class="center">Laboratorios y Líneas de investigación</th>
                                <th style = "min-width: 400px;" class="center">Sectores Industriales que atiende</th>
                                <th style = "min-width: 400px;" class="center">Equipamiento especializado</th>
                                <th style = "min-width: 400px;" class="center">Servicios a la industria</th>
                                <th class="center">Responsable del Laboratorio o Línea de Investigación</th>
                                <th style = "min-width: 300px;" class="center">Editar / Eliminar</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $space = "<br>";

                                //CONSULTA
                                $query = mysqli_query($connection, "SELECT * FROM uci_labs ul 
                                INNER JOIN uci_instituciones ui ON ul.fk_institucion = ui.id_institucion
                                INNER JOIN estado est ON ui.estado = est.idestado
                                INNER JOIN uci_ambito am ON ul.fk_ambito = am.id_ambito
                                INNER JOIN uci_areas_conocimiento uac ON ul.fk_area_conocimiento = uac.id_area_conocimiento
                                WHERE id_institucion = '$lab_id'
                                ");

                                $result = mysqli_num_rows($query);

                                if($result > 0){
                                    while ($data = mysqli_fetch_array($query)){
                            ?>
                                    <tr class="active-row">
                                        <td class="negritas center"><?php echo $data["nombre_institucion"]?></td>
                                        <td class="negritas center"><?php echo $data["estado"]?></td>
                                        <td class="center"><?php echo $data["nombre_ambito"]?></td>
                                        <td class="center"><?php echo $data["nombre_area_conocimiento"]?></td>
                                        <td class="center"><?php echo $data["laboratorio"]?></td>
                                        <td class="center"><?php echo $data["industria"]?></td>
                                        <td class="col_nombre bold center"><?php echo $data["equipo"]?></td>
                                        <td class="center"><?php echo $data["servicio"]?></td>
                                        <td class="center"><?php echo $data["nombre_responsable"]; echo $space;
                                                                    echo $data["email_responsable"]; echo $space; 
                                                                    echo $data["telefono_responsable"]; echo $space; ?></td>
                                        <td class="center">
                                            <a type = "button" class="btn yellow darken-3" href="editar_laboratorio_individual?id_lab=<?php echo $data["id_lab"];?>">Editar</a>
                                            <a type = "button" class="btn red darken-3" href="eliminar_laboratorio_individual?id_lab=<?php echo $data["id_lab"];?>">Eliminar</a>
                                        </td>
                                        
                                    </tr>

                            <?php
                                    }
                                }

                                if ($result == 0) {
                                    echo $message;
                                }
                            ?>
                        </tbody>
                    </table>
                </section>

                <a href="directorio_ies" class="btn">Regresar</a>
            </div>
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="public/js/init.js"></script>

    </body>
    </html>