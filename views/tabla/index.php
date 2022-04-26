<?php
        include "public/php/conexion.php";
        require_once ("controllers/tabla.php");
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
        <?php require 'views/sidenav.php'; ?>

        <div class="section wrapper">

            <?php if ($_SESSION['userType'] == 3) :?>
                <h3>Hola Adminisdtrador</h3>
            <?php endif?>

            <?php if ($_SESSION['userType'] == 2) :?>
                <h3>Hola Académico</h3>
            <?php endif?>

            <?php if ($_SESSION['userType'] == 1) :?>
                <h3>Hola Empresario</h3>
            <?php endif?>



            <?php if($_SESSION['userType' == 2]){?>     
                <h3>Hola Administrador</h3>
            <?php
            }?>
            
            <section id="labsIng" class="lab_table table_container">
                     <table class="table sticky" id="">
                        <thead>
                            <tr class="tr">
                                <th style = "min-width: 400px;" class="center">Institución</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="active-row">
                                <td class="negritas center"><?php print_r($result);?></td>           
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

    </body>
    </html>