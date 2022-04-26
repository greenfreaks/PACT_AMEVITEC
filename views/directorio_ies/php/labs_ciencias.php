    <?php
        include "../index.php";
        $id_ciencias = $_GET["id_ciencias"];
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
        <link rel="stylesheet" href="../css/table_labs.css">


       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

        <title>
        </title>
    </head>
    <body>

        <style type="text/css">
            #chooseTables{
                display:none;
            }
            .table_container, .searcher_container{
                display: none;
            }
        </style>

        <div class="section wrapper">
            <section id="labsCiencias">
                <?php 

                //CONSULTA
                    $query_name = mysqli_query($connection, "SELECT * FROM uci_labs ul 
                    INNER JOIN uci_instituciones ui ON ul.fk_institucion = ui.id_institucion
                    WHERE ul.fk_institucion = '$id_ciencias' LIMIT 1");

                    $result_name = mysqli_num_rows($query_name);

                    if($result_name > 0){
                        while ($data = mysqli_fetch_array($query_name)){
                ?>
                        <h5 class="texto-marino">Capacidades de investigación científica.</h5>
                        <h6 class="negritas"> Institución: </h6 class="negritas">
                        <h6 class="texto-azul negritas"><?php echo $data["nombre_institucion"]?></h6>

                <?php
                    }
                }
                ?>
                </section>
            <section id="labsCiencias" class="lab_table">
                     <table class="table sticky">
                        <thead>
                            <tr class="tr">
                                <th>Laboratorio</th>
                                <th>Área de conocimiento</th>
                                <th>Industria</th>
                                <th>Equipo</th>
                                <th>Servicio</th>
                                <th>Nombre y correo de contacto del responsable del laboratorio</th>
                                <th>Teléfono de contacto del responsable del laboratorio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                                //CONSULTA
                                $query = mysqli_query($connection, "SELECT * FROM uci_labs ul 
                                INNER JOIN uci_instituciones ui ON ul.fk_institucion = ui.id_institucion
                                INNER JOIN uci_ambito ua ON ul.fk_ambito = ua.id_ambito
                                INNER JOIN uci_areas_conocimiento uac ON ul.fk_area_conocimiento = uac.id_area_conocimiento
                                WHERE id_institucion = '$id_ciencias' AND id_ambito = 1");

                                $result = mysqli_num_rows($query);

                                if($result > 0){
                                    while ($data = mysqli_fetch_array($query)){
                            ?>
                                    <tr class="active-row">
                                        <td><?php echo $data["laboratorio"]?></td>
                                        <td><?php echo $data["nombre_area_conocimiento"]?></td>
                                        <td><?php echo $data["industria"]?></td>
                                        <td class="bold"><?php echo $data["equipo"]?></td>
                                        <td><?php echo $data["servicio"]?></td>
                                        <td><?php echo $data["nombre_correo_responsable"]?></td>
                                        <td><?php echo $data["telefono_responsable"]?></td>
                                       
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

                <section>
                    <a class="btn" href="../">Regresar</a>
                </section>
        </div>

    </body>
    </html>