    <?php
        include "public/php/conexion.php";

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
        <link rel="stylesheet" href="public/css/style.css">
        <link rel="stylesheet" href="public/css/table_labs.css">


       <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <title>
        </title>
    </head>
    <body>
        <!--<div class="searcher_container wrapper">
            <form action="php/search_user.php" method="GET">
                <input type="text" name="search" id="search" placeholder="Buscar...">
                <input type="submit" name="" value="Buscar" class="btn">
            </form>
        </div> -->
        
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

                <section class="table_container">
                    <table class="table sticky" id="">
                        <thead>
                            <tr class="tr">
                                <th class>Uni / CI</th>
                                <th>Tipo de institución</th>
                                <th>Estado</th>
                                <th>Página Web</th>
                                <th>Titular de la rectoría</th>
                                <th>Titular del área de vinculación</th>
                                <th>Titular del área académica</th>
                                <th>Áreas de oferta educativa</th>
                                <th>Áreas de oferta de educación continua</th>
                                <th>Laboraorios del área de ingeniería</th>
                                <th>Laboraorios del área de salud</th>
                                <th>Laboraorios del área de economía</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                                //PAGINADOR
                                /*$sql_register = mysqli_query($connection, "SELECT COUNT(*) AS total_registro FROM uci_form_unis_cis");
                                $result_register = mysqli_fetch_array($sql_register);
                                $total_registro = $result_register['total_registro'];

                                $por_pagina = 5;

                                if(empty($_GET['pagina'])){
                                    $pagina = 1;
                                }else{
                                    $pagina = $_GET['pagina'];
                                }

                                $desde = ($pagina-1) * $por_pagina;
                                $total_paginas = ceil($total_registro / $por_pagina);*/

                                //CONSULTA
                                $query = mysqli_query($connection, "SELECT * FROM uci_form_unis_cis u INNER JOIN uci_tipo_institucion t ON u.tipo_institucion = t.id_tipo_institucion INNER JOIN estado e ON u.estado = e.idestado");

                                $result = mysqli_num_rows($query);

                                if($result > 0){
                                    while ($data = mysqli_fetch_array($query)){
                            ?>

                                    <tr class="active-row">
                                        <td><?php echo $data["nombre_uni_ci"]?></td>
                                        <td><?php echo $data["tipo_institucion"]?></td>
                                        <td><?php echo $data["estado"]?></td>
                                        <td class="more_with"><?php echo $data["webpage"]?></td>
                                        <td><?php echo $data["tit_rectoria"]?></td>
                                        <td><?php echo $data["tit_vinculacion"]?></td>
                                        <td><?php echo $data["tit_academia"]?></td>
                                        <td class="more_with"><?php echo $data["areas_oferta_educativa"]?></td>
                                        <td class="more_with"><?php echo $data["areas_educacion_continua"]?></td>
                                        <td><a class="btn" href="php/labs_ing.php?id_ing=<?php echo $data["id"];?>">Detalles</a></td>
                                        <td><a type = "button" class="btn" href="php/labs_salud.php?id_salud=<?php echo $data["id"];?>">Detalles</a></td>
                                        <td><a type = "button" class="btn" href="php/labs_econo.php?id_econo=<?php echo $data["id"];?>">Detalles</a></td>
                                    </tr>
                            <?php
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </section>

        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </body>
    </html>