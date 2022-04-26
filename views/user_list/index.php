<?php
        include "models/buscadorUsuariosmodel.php";
        #error_reporting(E_ERROR);

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

<!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 

<!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        
        <link rel="stylesheet" href="public/css/style.css">


       <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <!-- DATA TABLES CSS -->
        <link rel="stylesheet" type="text/css" href="public/libraries/DataTables/datatables.min.css"/>

        <title>
        </title>
    </head>
    <body>

    <?php require 'views/header.php'; ?> 
    <?php require 'views/sidenav.php'; ?> 
        <div class="section wrapper">
            <div class="content_container">
                <h5>Lista de usuarios del PACT</h5>
                <div id="talentos">
                <p>Busca por nombre, id o por palabra clave</p>
                <input type="text" id="myInput" placeholder="Buscar...">
                    <section class="table_container">
                        <table id="myTable" class="table sticky bold">
                            <thead>
                                <tr class="tr">
                                    <th style = "min-width: 300px;" class="center">Nombre</th>
                                    <th style = "min-width: 300px;" class="center">Tipo de usuario</th>
                                    <th style = "min-width: 300px;" class="center">ID</th>
                                    <th style = "min-width: 350px;" class="center">Apellido paterno</th>
                                    <th style = "min-width: 350px;" class="center">Apellido materno</th>
                                    <th style = "min-width: 300px;" class="center">Fecha de Nacimiento</th>
                                    <th style = "min-width: 350px;" class="center">Email</th>
                                    <th style = "min-width: 300px;" class="center">Celular</th>
                                    <th style = "min-width: 300px;">Fecha de registro</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $obj = new usuariosPact();
                                    if($obj->conectar()){
                                        $usuarios = $obj->getUsuarios();
                                        foreach($usuarios AS $user){?>
                                            <tr class="active-row">
                                                <td class="center col_sticky"><?php echo $user['nombre'];?></td>
                                                <td class="center col_sticky"><?php echo $user['tipo_usuario'];?></td>
                                                <td class="center"><?php echo $user['idusuario_general'];?></td>
                                                <td class="center col_sticky"><?php echo $user['apellido_paterno'];?></td>
                                                <td class="center col_sticky"><?php echo $user['apellido_materno'];?></td>
                                                <td class="center"><?php echo $user['fecha_nacimiento'];?></td>
                                                <td class="center col_sticky"><?php echo $user['correo'];?></td>
                                                <td class="center col_sticky"><?php echo $user['celular'];?></td>
                                                <td class="center col_sticky"><?php echo $user['createdAt'];?></td>
                                            </tr>

                                        <?php
                                        }
                                    }
                                ?>
                            </tbody>

                        </table>
                    </section>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

        <!-- DATA TABLES JS -->
        <<script>
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