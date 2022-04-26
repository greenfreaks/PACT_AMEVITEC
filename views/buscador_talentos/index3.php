    <?php
        include "public/php/conexion.php";
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

<!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 

<!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

<!--Import jQuery before materialize.js-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        
        <link rel="stylesheet" href="public/css/style.css">


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

        <form method="POST" class="filtros">
            <p>Utiliza los filtros de búsqueda para encontrar lo que necesitas.</p>
            <div class="searcher">
                <input type="text" placeholder="Escribe aquí lo que estés buscando..." name="searcher" value="<?php echo $_POST["searcher"] ?>">
            </div>

            <div class="funcion_filter">
                <h6>Seleccione una función.</h6>
                <select name="funcion" id="" class="browser-default">
                    <?php if($_POST['funcion'] !=""){?>
                        <option value="<?php echo $_POST['funcion'];?>"><?php echo $_POST['funcion'];?></option>
                    <?php } ?>
                        
                    <option value="">Todos</option>

                    <?php include "php/llenado_funcion.php" ?>

                </select>
            </div> <br>

                <button class="btn" type="submit">Buscar</button>
                <a href="buscador_talentos" class="bold">Limpiar filtros</a>

                <?php 
                    include "php/filtros.php"
                ?>
            </form>

            <div id="talentos">
                <section class="table_container">
                    <table id="" class="table sticky bold">
                <thead>
                <tr class="tr">
                    <th scope="col">Grado Académico</th>
                    <th scope="col">Título Obtenido</th>
                    <th scope="col">Escuela</th>
                    <th scope="col">Organización a la que pertenece actualmente</th>
                    <th scope="col">Función dentro de la organización</th>
                    <th scope="col">Campo del conocimiento en el que ha desarrollado su experiencia</th>
                    <th scope="col">Disciplina</th>
                    <th scope="col">Subdisciplina</th>
                    <th scope="col">Solicitar</th>
                    
                </tr>
                </thead>
                
                <tbody id="cuerpo">

                </tbody>
               
            </table>
            </section>

            </div>
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            const tabla = document.querySelector('#cuerpo');
            const opciones = {
                method: 'POST'
            }

            fetch('php/consulta.php', opciones)
            .then(respuesta => respuesta.json())
            .then(resultado =>{
                resultado.forEach(elemento =>{
                    tabla.innerHTML += `
                    <tr>
                        <td id="grado" scope="row">${elemento.titulo_obtenido} </td>
                        <td id="titulo" scope="row"> </td>
                        <td id="escuela" scope="row"></td>
                        <td id="organizacion" scope="row"> </td>
                        <td id="funcion" scope="row"> </td>
                        <td id="campo" scope="row"> </td>
                        <td id="disciplina" scope="row"> </td>
                        <td id="subdisciplina" scope="row"></td>
                       <!-- <td>

                            <form method="POST">
                                <a href="submit_wp?idusuario_general=<?php #echo $data["idusuario_general"];
                                ?>" class="texto-verde negritas">WhatsApp</a>
                        </td>
                    </form>-->
                    </tr>
                    `
                });
            });

            </script>
            
            

    </body>
    </html>