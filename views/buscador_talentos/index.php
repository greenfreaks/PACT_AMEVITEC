<?php
    require_once "models/buscador_talentos_model.php";
    // error_reporting(E_ERROR);
?>
<?php require "views/include_views/templates/html1.php"?>
<div class="section wrapper">
    <div class="content_container">
        <p>Busca palabra clave.</p>
        <input type="text" id="myInput" placeholder="Ingresa palabra clave...">
        <section id="labsIng" class="lab_table table_container">
            <table class="table sticky" id="myTable">
                <thead>
                    <tr class="tr">
                        <th class="center">ID</th>
                        <th style="min-width: 300px;" class="center">Grado Académico</th>
                        <th style="min-width: 200px;" class="center">Ubicación</th>
                        <th style="min-width: 250px;" class="center">Expertise</th>
                        <th style="min-width: 250px;" class="center">Principal interés</th>
                        <th style="min-width: 250px;" class="center">Sector de experiencia</th>
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

<?php require "views/include_views/templates/html2.php"?>