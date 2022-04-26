<?php
include "models/buscador_institucionesmodel.php";
error_reporting(E_ERROR);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description"
        content="Somos la Agencia Mexicana de Vinculación Tecnológica, una asociación civil sin fines de lucro dedicada a promover, gestionar y capacitar la vinculación entre empresas y universidades.">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PACT</title>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>

    <link rel="stylesheet" href="public/css/materialize.css">
    <link rel="stylesheet" href="public/css/style.css">
    <link rel="stylesheet" href="public/css/table_labs.css">


    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <title>
    </title>
</head>

<body>


    
<?php require 'views/header.php'; ?>
    <?php require 'views/sidenav.php'; ?>

    <div class="section wrapper">
        <div class="content_container">
        <h5>Catálogo de IES y Centos de I+D</h5>
        <?php if ($_SESSION['userType'] == 3) :?>
            <div id="chooseTables">
                <h6>Utiliza estos botones para consultar el <b class="texto-marino"> Catálogo de las Instituciones de Educación Superior (IES)
                    y los Centros de Investigación y Desarrollo (Centros de I+D).</b>
                    o bien, el <b class="texto-marino">inventario de sus laboratorios y proyectos.</b></h6>
                    
                <a class="btn" href="#">IES y Centros de I+D</a>
                <a class="btn" href="index">Laboratorios y Proyectos</a>
            </div>
            <div class="filters">
                <p>Busca palabra clave.</p>
                <input type="text" id="myInput" placeholder="Ingresa palabra clave...">
            </div> <br>

            <section id="listadoUnisCis" class="lab_table table_container">
                <table class="table sticky">
                    <thead>
                        <tr class="tr">
                            <th style="min-width: 300px;" class="center">Nombre de la institucion</th>
                            <th style="min-width: 300px;" class="center">ID</th>
                            <th style="min-width: 300px;" class="center">Tipo de institución</th>
                            <th style="min-width: 200px;" class="center">Entidad federativa</th>
                            <th style="min-width: 350px;" class="center">Áreas de investigación</th>
                            <th style="min-width: 350px;">Servicios de educación continua</th>
                            <th style="min-width: 200px;" class="center">Laboratorios y líneas de investigación</th>
                            <th style="min-width: 250px;" class="center">Página web</th>
                            <th style="min-width: 350px;">Contacto</th>
                            <th style="min-width: 350px;" class="center">Contraseña</th>
                            <th style="min-width: 200px;" class="center">Fecha de registro</th> 
                            <th style="min-width: 200px;" class="center">Última modificación</th> 
                            <th style="min-width: 200px;" class="center">Editar / Eliminar</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php 
                            $obj = new Instituciones();
                            if($obj->conectar()){
                                $instituciones = $obj->getInstituciones();
                                foreach($instituciones as $ins){?>

                                    <tr class="active-row">
                                        <td class="col_sticky center"><?php echo $ins['nombre_institucion'];?></td>
                                        <td class="col_sticky center"><?php echo $ins['id_institucion'];?></td>
                                        <td class="col_sticky center"><?php echo $ins['tipo_institucion'];?></td>
                                        <td class="center"><?php echo $ins['estado'];?></td>

                                        <td>                                          
                                            <ul class="collapsible">
                                                <li>
                                                    <div class="collapsible-header"><i class="material-icons">science</i>Ver</div>
                                                    <div class="collapsible-body">
                                                        <span>
                                                            <?php
                                                            $areas_investigacion= $obj->getAreasInvestigacion( $ins['id_institucion']);
                                                            foreach($areas_investigacion as $oferta_e){?>  
                                                                <ol type="disc">
                                                                    <li><?php echo $oferta_e['nombre_area_oferta'];?></li> <br>
                                                                </ol type="disc">
                                                                <?php
                                                                }
                                                                ?>
                                                        </span>
                                                    </div>
                                                    </li>
                                                </ul>
                                        </td>

                                        <td class="center">
                                            <!-- <ul class="collapsible">
                                                <li>
                                                    <div class="collapsible-header"><i class="material-icons">science</i>Ver</div>
                                                    <div class="collapsible-body">
                                                        <span> -->
                                                            <?php
                                                            $servicios_educacion_continua= $obj->getServiciosEducacion( $ins['id_institucion']);
                                                            foreach($servicios_educacion_continua as $educacion_c){?>  
                                                                <ol type="disc">
                                                                    <li><?php echo $educacion_c['nombre_area_educacion_continua'];?></li>
                                                                </ol type="disc">
                                                                <?php
                                                                }
                                                                ?>
                                                        <!-- </span>
                                                    </div>
                                                    </li>
                                                </ul> -->
                                        </td>
                                        <td class="center"><a type = "button" class="btn" href="individual_lab?lab_id=<?php echo $ins["id_institucion"];?>">Detalles</a></td>
                                        <td class="center"><?php echo $ins['webpage'];?></td>
                                        <td>   
                                            <ul class="collapsible">
                                                <li>
                                                    <div class="collapsible-header"><i class="material-icons">contact_mail</i>Ver contactos</div>
                                                    <div class="collapsible-body">
                                                        <span>
                                                            <?php
                                                                echo "<h6>Titular de la rectoría:</h6>" . "<br>" .
                                                                $ins['tit_rectoria'] . "<br>" . 
                                                                $ins['email_rectoria'] . "<br>" . "<br>" .

                                                                "<h6>Titular de área de vinculación</h6>" . "<br>" . 
                                                                $ins['tit_vinculacion'] . "<br>" . 
                                                                $ins['email_vinculacion'] . "<br>" . "<br>" .
                                                                
                                                                "<h6>Titular de área académica</h6>" . "<br>" . 
                                                                $ins['tit_academia'] . "<br>" . 
                                                                $ins['email_academia']; 
                                                            ?>
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
        
                                        </td>
                                        <td class="center"><?php echo $ins['password'];?></td>
                                        <td class="center"><?php echo $ins['createdAt'];?></td>
                                        <td class="center"><?php echo $ins['modifiedAt'];?></td>
                                        <td class="center">
                                            <a type = "button" class="btn yellow darken-3" href="editar_institucion?id_institucion=<?php echo $ins["id_institucion"];?>">Editar</a> <br>
                                            <a type = "button" class="btn red darken-3" href="eliminar_institucion?id_institucion=<?php echo $ins["id_institucion"];?>">Eliminar</a>
                                        
                                        </td>
                                        
                                    </tr>
                                    
                                    
                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </section>
        <?php endif?>
        <?php if ($_SESSION['userType'] == 1 || $_SESSION['userType'] == 2) :?>
                <div id="chooseTables">
                <h6>Utiliza estos botones para consultar el <b class="texto-marino"> Catálogo de las Instituciones de
                        Educación Superior (IES)
                        y los Centros de Investigación y Desarrollo (Centros de I+D).</b>
                    o bien, el <b class="texto-marino">inventario de sus laboratorios y proyectos.</b></h6>

                <a class="btn" href="index">Laboratorios y Proyectos</a>
                <a class="btn" href="#">IES y Centros de I+D</a>
            </div>

            <input type="text" id="myInput">

            <section id="listadoUnisCis" class="lab_table table_container">
                <table class="table sticky">
                    <thead>
                        <tr class="tr">
                            <th style="min-width: 300px;" class="center">Nombre de la institución</th>
                            <th style="min-width: 200px;" class="center">Entidad federativa</th>
                            <th style="min-width: 350px;" class="center">Áreas de investigación</th>
                            <th style="min-width: 350px;">Servicios de educación continua</th>
                            <th style="min-width: 200px;" class="center">Laboratorios y líneas de investigación</th>
                            <th style="min-width: 250px;" class="center">Página web</th>
                            <th style="min-width: 350px;">Contacto</th>
                            <th style="min-width: 200px;" class="center">Editar</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <?php 
                            $obj = new Instituciones();
                            if($obj->conectar()){
                                $instituciones = $obj->getInstituciones();
                                foreach($instituciones as $ins){?>

                        <tr class="active-row">
                            <td class="col_sticky center"><?php echo $ins['nombre_institucion'];?></td>
                            <td class="center"><?php echo $ins['estado'];?></td>

                            <td>
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header"><i class="material-icons">science</i>Ver</div>
                                        <div class="collapsible-body">
                                            <span>
                                                <?php
                                                            $areas_investigacion= $obj->getAreasInvestigacion( $ins['id_institucion']);
                                                            foreach($areas_investigacion as $oferta_e){?>
                                                <ol type="disc">
                                                    <li><?php echo $oferta_e['nombre_area_oferta'];?></li> <br>
                                                </ol type="disc">
                                                <?php
                                                                }
                                                                ?>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </td>

                            <td class="center">
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header"><i class="material-icons">science</i>Ver</div>
                                        <div class="collapsible-body">
                                            <span>
                                                <?php
                                                            $servicios_educacion_continua= $obj->getServiciosEducacion( $ins['id_institucion']);
                                                            foreach($servicios_educacion_continua as $educacion_c){?>
                                                <ol type="disc">
                                                    <li><?php echo $educacion_c['nombre_area_educacion_continua'];?>
                                                    </li>
                                                </ol type="disc">
                                                <?php
                                                                }
                                                                ?>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </td>

                            <td class="center">
                                <a type="button" class="btn"
                                    href="individual_lab?lab_id=<?php echo $ins["id_institucion"];?>">Ver oferta</a>
                            </td>
                            <td class="center"><?php echo $ins['webpage'];?></td>
                            <td>
                                <ul class="collapsible">
                                    <li>
                                        <div class="collapsible-header"><i class="material-icons">contact_mail</i>Ver
                                            contactos</div>
                                        <div class="collapsible-body">
                                            <span>
                                                <?php
                                                                echo "<h6>Titular de la rectoría:</h6>" . "<br>" .
                                                                $ins['tit_rectoria'] . "<br>" . 
                                                                $ins['email_rectoria'] . "<br>" . "<br>" .

                                                                "<h6>Titular de área de vinculación</h6>" . "<br>" . 
                                                                $ins['tit_vinculacion'] . "<br>" . 
                                                                $ins['email_vinculacion'] . "<br>" . "<br>" .
                                                                
                                                                "<h6>Titular de área académica</h6>" . "<br>" . 
                                                                $ins['tit_academia'] . "<br>" . 
                                                                $ins['email_academia']; 
                                                            ?>
                                            </span>
                                        </div>
                                    </li>
                                </ul>

                            </td>
                            <td class="center"><a type="button" class="btn yellow darken-3"
                                    href="editar_institucion?id_institucion=<?php echo $ins["id_institucion"];?>">Editar</a>
                            </td>

                        </tr>


                        <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </section>
            <?php endif?>
            
        </div>

        <script src="public/js/init.js"></script>
        <script src="public/js/evitar_reenvio.js"></script>
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

        <script>
            $(document).ready(function () {
                $('#listadoUnisCis').doubleScroll();
            });
        </script>



</body>

</html>