<?php
    require_once "models/buscador_talentos_model.php";
    // error_reporting(E_ERROR);
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
                <a class="brand-logo center">Talentos</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
        <?php require 'views/sidenav.php'; ?>

        <div class="section wrapper">
            <div class="content_container">
            <p>Busca palabra clave.</p>
                <input type="text" id="myInput" placeholder="Ingresa palabra clave...">    
                <section id="labsIng" class="lab_table table_container">
                     <table class="table sticky" id="myTable">
                        <thead>
                            <tr class="tr">
                                <th class="center">ID</th>
                                <th style = "min-width: 300px;" class="center">Grado Académico</th>
                                <th style = "min-width: 200px;" class="center">Ubicación</th>
                                <th style = "min-width: 250px;" class="center">Expertise</th>
                                <th style = "min-width: 250px;" class="center">Principal interés</th> 
                                <th style = "min-width: 250px;" class="center">Sector de experiencia</th>
                                <!-- <th style = "min-width: 250px;" class="center">Solicitar</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $obj = new Talentos();
                                if($obj->conectar()){
                                $talentos = $obj->getTalents();
                                    
                                foreach($talentos as $tal){?>
                                    <tr class="active-row">
                                        <td class="center col_sticky"><?php echo $tal['idperfil_academico']?></td>
                                        <td class="center"><?php echo $tal['titulo_obtenido']?></td>
                                        <td class="center"><?php echo $tal['estado']?></td>
                                        <td class="center">
                                            <?php 
                                            $expertise = $obj->getExpertise( $tal['idperfil_academico'] );
                                            foreach($expertise as $exp){?>

                                                <ol type="disc">
                                                    <li class="collection-item"><?php echo $exp['actividad_experiencia'];?></li>
                                                </ol>
                                                
                                            <?php
                                            }?>
                                        </td>

                                        <td class="center"> 
                                            <?php 
                                            $interes = $obj->getInteres( $tal['idperfil_academico'] );
                                            foreach($interes as $int){?>
                                                <ol type="disc">
                                                    <li><?php echo $int['actividad_desarrollo'];?></li>
                                                </ol type="disc">
                            
                                                <?php
                                            }
                                            ?>
                                        </td>

                                        <td class="center">
                                            <?php 
                                            $sector_experiencia = $obj->getSectorExperiencia( $tal['idperfil_academico'] );
                                            foreach($sector_experiencia as $sector){?>

                                                <ol type="disc">
                                                    <li><?php echo $sector['organizacion'];?></li>
                                                </ol>
                                                
                                            <?php
                                            }
                                            ?>
                                        </td>
                                                   
                                    <?php

                                    }
                                    }
                            ?> 
                            </tr>
                           
                        </tbody>
                    </table>
                </section> 

            </div>  
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="public/js/init.js"></script>
        <script>
            $(document).ready(function () {
                $("#myInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>

    </body>
    </html>
