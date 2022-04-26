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
        <?php include "views/header.php";?>
    </div>
        <?php require 'views/sidenav.php'; ?>

        <div class="section wrapper">
            <div class="content_container">
                <h5>Inventario de laboratorios y proyectos</h5>
            <div id="chooseTables">
                <h6>Utiliza estos botones para consultar el <b class="texto-marino"> Catálogo de las Instituciones de Educación Superior (IES)
                    y los Centros de Investigación y Desarrollo (Centros de I+D).</b>
                    o bien, el <b class="texto-marino">inventario de sus laboratorios y proyectos.</b></h6>

                <a class="btn" href="directorio_ies">IES y Centros de I+D</a>
                <a class="btn" href="#">Laboratorios y Proyectos</a>
            </div>

            <div id="listadoLabs">
                <p>Utiliza los filtros de búsqueda para encontrar lo que necesitas.</p>

        <form method="POST" class="filtros">

            <div class="searcher">
                <input type="text" placeholder="Escribe aquí lo que estés buscando..." name="buscar_texto" value="<?php echo $_POST["buscar_texto"] ?>">
            </div>

            <div class="institucion_filter">
                <h6>Seleccione una institución</h6>
                <select name="nombre_institucion" id="" class="browser-default">
                    <?php if($_POST['nombre_institucion'] !=""){?>
                        <option value="<?php echo $_POST['nombre_institucion'];?>"><?php echo $_POST['nombre_institucion'];?></option>
                    <?php } ?>
                        
                    <option value="">Todos</option>
                    <?php
                        include "php/llenado_instituciones.php"
                    ?>
                    </select>
                </div>

                <div class="ambito_filter">
                    <h6>Seleccione un ámbito</h6>


                    <select name="nombre_ambito" id="" class="browser-default">
                        <?php if($_POST['nombre_ambito'] !=""){?>
                            <option value="<?php echo $_POST['nombre_ambito'];?>"><?php echo $_POST['nombre_ambito'];?></option>
                        <?php } ?>
                        <option value="">Todos</option>
                        <?php
                            include "php/llenado_ambito.php"
                        ?>
                    </select>
                </div>

                <div class="industria_filter">
                    <h6>Seleccione una industria</h6>
                    <select name="industria" id="" class="browser-default" >
                        <?php if($_POST['industria'] !=""){?>
                            <option value="<?php echo $_POST['industria'];?>"><?php echo $_POST['industria'];?></option>
                        <?php } ?>
                        <option value="">Todos</option>
                        <?php
                            include "php/llenado_industria.php"
                        ?>
                    </select>
                </div>

                <button class="btn" type="submit">Buscar</button>
                <a href="index.php" class="bold">Limpiar filtros</a>

                <?php 
                    include "php/labs_filtros.php"
                ?>
            </form>
            
            
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
                                $where
                                ORDER BY nombre_institucion ASC
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
                                            <a type = "button" class="btn yellow darken-3" href="editar_laboratorios?id_lab=<?php echo $data["id_lab"];?>">Editar</a>
                                            <a type = "button" class="btn red darken-3" href="eliminar_laboratorio?id_lab=<?php echo $data["id_lab"];?>">Eliminar</a>
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
            </div>
            </div>
        </div>

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="public/js/init.js"></script>

    </body>
    </html>