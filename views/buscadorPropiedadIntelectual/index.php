<?php
include "public/php/conexion.php";
?>
<html>

<head>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="public/css/style.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PACT - Propiedad Intelectual </title>

</head>

<body>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper container">
                <a class="brand-logo center">Propiedad Intelectual</a>
                <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            </div>
        </nav>
    </div>
    <?php require 'views/sidenav.php'; ?> 

    <div class="section wrapper texto-negro">
        <div class = "content_container">
        <div id="listadoUnisCis">
            <section class="table_container">
            <table id="" class="table sticky">
                <thead>
                <tr class="tr">
                    <th class="center" style="min-width: 250px;">Nombre de la tecnología.</th>
                    <th class="center" style="min-width: 250px;">Titular.</th>
                    <th class="center" style="min-width: 250px;">Inventores.</th>
                    <th class="center" style="min-width: 250px;">Tipo de Propiedad Intelectual.</th>
                    <th class="center" style="min-width: 250px;">Título.</th>
                    <th class="center" style="min-width: 250px;">Resumen.</th>
                    <th class="center" style="min-width: 250px;">Sector industrial.</th>
                    <th class="center" style="min-width: 250px;">Estatus</th>
                    <th class="center" style="min-width: 250px;">Región de la protección</th>
                    <th class="center">No. de patente/ Solicitud/ Registro.</th>
                    <th class="center" style="min-width: 250px;">Enlace Web.</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                                $space = "<br>";

                                $query = mysqli_query($connection, "SELECT * FROM tec_propiedad_intelectual prop 
                                
                                ");

                                $result = mysqli_num_rows($query);

                                if($result > 0){
                                    while ($data = mysqli_fetch_array($query)){
                            ?>
                <tr class="active-row">
                    <td class="col_sticky center"><?php echo $data['nombre_tec']?></td>
                    <td class="center"><?php echo $data['titular_propiedad']?></td>
                    <td class="center"><?php echo $data['inventores']?></td>
                    <td class="center"><?php echo $data['fk_tipo_propiedad']?></td>
                    <td class="center"><?php echo $data['titulo_propiedad']?></td>
                    <td class="center"><?php echo $data['resumen_propiedad']?></td>
                    <td class="center"><?php echo $data['sector_propiedad']?></td>
                    <td class="center"><?php echo $data['estatus']?></td>
                    <td class="center"><?php echo $data['region_propiedad']?></td>
                    <td class="center"><?php echo $data['numero_patente']?></td>
                    <td class="center"><?php echo $data['link']?></td>
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
    <script src="public/js/init.js"></script>
</body>

</html>