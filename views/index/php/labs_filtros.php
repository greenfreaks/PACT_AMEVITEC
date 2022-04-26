<?php 
                /*--------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------VARIABLES DE BÚSQUEDA------------------------------------------*/
                /*--------------------------------------------------------------------------------------------------------*/

                    $where= "";
                    $nombre_institucion = $_POST["nombre_institucion"];
                    $nombre_ambito = $_POST["nombre_ambito"];
                    $industria = $_POST["industria"];
                    $buscar_texto = $_POST["buscar_texto"];
                    $message = "<h5 class = 'bold'>No se encontraron resultados de su búsqueda</h5>";

                /*---------------------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------CONDICIONES-----------------------------------------------------------------*/
                /*---------------------------------------------------------------------------------------------------------------------*/

                    if ($nombre_institucion =="" && $nombre_ambito =="" && $industria =="" && $buscar_texto =="") {
                        $where = "";

                    }else{
                /*---------------------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------CONDICIONES FILTROS SOLOS---------------------------------------------------*/
                /*---------------------------------------------------------------------------------------------------------------------*/

                        if ($nombre_institucion !="" && $nombre_ambito =="" && $industria =="" && $buscar_texto =="") {
                            $where = "WHERE nombre_institucion = '$nombre_institucion'";
                        }

                        if ($nombre_institucion =="" && $nombre_ambito !="" && $industria =="" && $buscar_texto =="") {
                            $where = "WHERE nombre_ambito = '$nombre_ambito'";
                        }

                        if ($nombre_institucion =="" && $nombre_ambito =="" && $industria !="" && $buscar_texto =="") {
                            $where = "WHERE industria LIKE '%".$industria."%'";
                        }

                        if ($nombre_institucion =="" && $nombre_ambito =="" && $industria =="" && $buscar_texto !="") {
                            $where = "WHERE (equipo LIKE '%".$buscar_texto."%') OR (servicio LIKE '%".$buscar_texto."%') OR (descripcion LIKE '%".$buscar_texto."%')";
                        }

                /*------------------------------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------CONDICIONES BASADAS EN INSTITUCION---------------------------------------------------*/
                /*------------------------------------------------------------------------------------------------------------------------------*/
                        if ($nombre_institucion !="" && $nombre_ambito !="" && $industria =="" && $buscar_texto =="") {
                            $where = "WHERE nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$nombre_ambito'";
                        }

                        if ($institucion !="" && $ambito =="" && $industria !="" && $buscar_texto =="") {
                            $where = "WHERE nombre_institucion = '$nombre_institucion' AND industria LIKE '%".$industria."%'";
                        }

                        if ($nombre_institucion !="" && $nombre_ambito =="" && $industria =="" && $buscar_texto !="") {
                            $where = "WHERE (nombre_institucion = '$nombre_institucion' AND equipo LIKE '%".$buscar_texto."%')
                            OR (Nombre_institucion = '$nombre_institucion' AND servicio LIKE '%".$buscar_texto."%')
                            OR (nombre_institucion = '$nombre_institucion' AND descripcion LIKE '%".$buscar_texto."%')";
                        }

                        if ($nombre_institucion !="" && $nombre_ambito !="" && $industria !="" && $buscar_texto =="") {
                            $where = "WHERE nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%'";
                        }

                        if ($nombre_institucion !="" && $nombre_ambito !="" && $industria !="" && $buscar_texto !="") {
                            $where = "WHERE (nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%'
                            AND equipo LIKE '%".$buscar_texto."%')

                            OR (nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%'
                            AND servicio LIKE '%".$buscar_texto."%')

                            OR (nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%'
                            AND descripcion LIKE '%".$buscar_texto."%')";
                        }

                /*------------------------------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------CONDICIONES BASADAS EN ÁMBITO--------------------------------------------------------*/
                /*------------------------------------------------------------------------------------------------------------------------------*/
                        if ($institucion !="" && $ambito !="" && $industria =="" && $buscar_texto =="") {
                            $where = "WHERE nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$nombre_ambito'";
                        }

                        if ($nombre_institucion =="" && $nombre_ambito !="" && $industria !="" && $buscar_texto =="") {
                            $where = "WHERE nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%'";
                        }

                        if ($nombre_institucion =="" && $nombre_ambito !="" && $industria =="" && $buscar_texto !="") {
                            $where = "WHERE (nombre_ambito = '$nombre_ambito' AND equipo LIKE '%".$buscar_texto."%')
                            OR (nombre_ambito = '$nombre_ambito' AND servicio LIKE '%".$buscar_texto."%')
                            OR (nombre_ambito = '$nombre_ambito' AND descripcion LIKE '%".$buscar_texto."%')";
                        }

                        if ($nombre_institucion =="" && $nombre_ambito !="" && $industria !="" && $buscar_texto !="") {
                            $where = "WHERE (ambito = '$ambito' AND industria LIKE '%".$industria."%' AND equipo LIKE '%".$buscar_texto."%')
                            OR (nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%' AND servicio LIKE '%".$buscar_texto."%')
                            OR (nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%' AND descripcion LIKE '%".$buscar_texto."%')";
                        }

                /*------------------------------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------CONDICIONES BASADAS EN INDUSTRIA-----------------------------------------------------*/
                /*------------------------------------------------------------------------------------------------------------------------------*/
                        /*if ($institucion !="" && $ambito =="" && $industria !="" && $buscar_texto =="") {
                            $where = "WHERE nombre_uni_ci = '$institucion' AND industria LIKE '%".$industria."%'";
                        }*/

                        if ($institucion =="" && $ambito !="" && $industria !="" && $buscar_texto =="") {
                            $where = "WHERE ambito = '$ambito' AND industria LIKE '%".$industria."%'";
                        }

                        if ($nombre_institucion =="" && $nombre_ambito =="" && $industria !="" && $buscar_texto !="") {
                            $where = "WHERE (industria LIKE '%".$industria."%' AND equipo LIKE '%".$buscar_texto."%') 
                            OR (industria LIKE '%".$industria."%' AND servicio LIKE '%".$buscar_texto."%')
                            OR (industria LIKE '%".$industria."%' AND descripcion LIKE '%".$buscar_texto."%')";
                        }

                        if ($nombre_institucion =="" && $nombre_ambito !="" && $industria !="" && $buscar_texto !="") {
                            $where = "WHERE (nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%' AND equipo LIKE '%".$buscar_texto."%') 
                            OR (nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%' AND servicio LIKE '%".$buscar_texto."%')
                            OR (nombre_ambito = '$nombre_ambito' AND industria LIKE '%".$industria."%' AND descripcion LIKE '%".$buscar_texto."%')";
                        }

                        if ($institucion !="" && $ambito !="" && $industria =="" && $buscar_texto !="") {
                            $where = "WHERE (nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$nombre_ambito' AND equipo LIKE '%".$buscar_texto."%') 
                            OR (nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$ambito' AND servicio LIKE '%".$buscar_texto."%')
                            OR (nombre_institucion = '$nombre_institucion' AND nombre_ambito = '$ambito' AND descripcion LIKE '%".$buscar_texto."%')";
                        }
                /*------------------------------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------CONDICIONES BASADAS EN BUSCADOR------------------------------------------------------*/
                /*------------------------------------------------------------------------------------------------------------------------------*/
                        /*if ($institucion !="" && $ambito =="" && $industria =="" && $buscar_texto !="") {
                            $where = "WHERE nombre_uni_ci = '$institucion' AND equipo LIKE '%".$buscar_texto."%' 
                            OR servicio LIKE '%".$buscar_texto."%' OR descripcion LIKE '%".$buscar_texto."%";
                        }*/

                        /*if ($institucion =="" && $ambito !="" && $industria =="" && $buscar_texto !="") {
                            $where = "WHERE ambito = '$ambito' AND equipo LIKE '%".$buscar_texto."%' 
                            OR servicio LIKE '%".$buscar_texto."%' OR descripcion LIKE '%".$buscar_texto."%";
                        }*/

                        /*if ($institucion =="" && $ambito =="" && $industria !="" && $buscar_texto !="") {
                            $where = "WHERE industria LIKE '%".$industria."%' AND equipo LIKE '%".$buscar_texto."%' 
                            OR servicio LIKE '%".$buscar_texto."%' OR descripcion LIKE '%".$buscar_texto."%'";
                        }*/

                        /*if ($institucion =="" && $ambito !="" && $industria !="" && $buscar_texto !="") {
                            $where = "WHERE ambito = '$ambito' AND industria LIKE '%".$industria."%' AND equipo LIKE '%".$buscar_texto."%' 
                            OR servicio LIKE '%".$buscar_texto."%' OR descripcion LIKE '%".$buscar_texto."%' ";
                        }*/
                    }

                ?>