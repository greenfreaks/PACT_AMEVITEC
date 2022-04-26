<?php 
                /*--------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------VARIABLES DE BÚSQUEDA------------------------------------------*/
                /*--------------------------------------------------------------------------------------------------------*/

                    $where= "";
                    $funcion = $_POST["funcion"];
                    $searcher = $_POST["searcher"];

                    $message = "<h5 class = 'bold'>No se encontraron resultados de su búsqueda</h5>";

                /*---------------------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------CONDICIONES-----------------------------------------------------------------*/
                /*---------------------------------------------------------------------------------------------------------------------*/

                    if ($funcion =="" && $searcher =="") {
                        $where = "";

                    }else{
                /*---------------------------------------------------------------------------------------------------------------------*/
                /*-----------------------------------------CONDICIONES FILTROS SOLOS---------------------------------------------------*/
                /*---------------------------------------------------------------------------------------------------------------------*/

                        if ($funcion !="" && $searcher =="") {
                            $where = "WHERE funcion_academico = '$funcion'";
                        }

                        if ($funcion =="" && $searcher !="") {
                            $where = "WHERE (grado_academico LIKE '%".$searcher."%')
                             		  OR (titulo_obtenido LIKE '%".$searcher."%')
                             		  OR (titulo_obtenido LIKE '%".$searcher."%')
                             		  OR (escuela LIKE '%".$searcher."%')
                             		  OR (funcion_academico LIKE '%".$searcher."%')
                             		  OR (disciplina LIKE '%".$searcher."%')
                             		  OR (subdisciplina LIKE '%".$searcher."%') ";
                        }

                        if ($funcion !="" && $searcher !="") {
                            $where = "WHERE funcion_academico = '$funcion' AND (grado_academico LIKE '%".$searcher."%')
                             		  OR (funcion_academico = '$funcion' AND titulo_obtenido LIKE '%".$searcher."%')
                             		  OR (funcion_academico = '$funcion' AND titulo_obtenido LIKE '%".$searcher."%')
                             		  OR (funcion_academico = '$funcion' AND escuela LIKE '%".$searcher."%')
                             		  OR (funcion_academico = '$funcion' AND funcion_academico LIKE '%".$searcher."%')
                             		  OR (funcion_academico = '$funcion' AND disciplina LIKE '%".$searcher."%')
                             		  OR (funcion_academico = '$funcion' AND subdisciplina LIKE '%".$searcher."%') ";
                        }
                    }
                ?>