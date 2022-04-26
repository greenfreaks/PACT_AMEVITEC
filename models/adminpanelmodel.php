<?php

    class AdminpanelModel extends Model{

        public function __construct(){
            parent::__construct();
        }

        public function getChartUsuarios(){
            $selected_users = [];
            try{
                $query_users = $this->db->connect()->query(
                    "SELECT `tipo_usuario_idtipo_usuario`,tipo_usuario.tipo_usuario as tipoUsuario, COUNT(*) as total
                    FROM `usuario_general`
                    INNER JOIN tipo_usuario on tipo_usuario.idtipo_usuario = tipo_usuario_idtipo_usuario
                    GROUP BY `tipo_usuario_idtipo_usuario`;");

                while($row_users = $query_users->fetch()){
                    $users=array();
                    $users['label'] = $row_users['tipoUsuario'];
                    $users['value'] = $row_users['total'];
                    array_push($selected_users, $users);
                }
                return $selected_users;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }
        
        public function getChartTRL($argumentos){

            /*
            Niveles TRL por proyectos
                -----------------------
                Para todos los niveles
                    getChartTRL([])
                ------------------------
                Para un rango de niveles
                    getChartTRL([
                        'minLevel' =>  1,
                        'maxLevel' =>  9
                        ]);
                -----------------------
            */
            
            $minLevel = !isset($argumentos['minLevel']) ? 1 : $argumentos['minLevel'];
            $maxLevel = !isset($argumentos['maxLevel']) ? 9 : $argumentos['maxLevel'];
            $minLevel = $minLevel < 1  ? 1 : $minLevel;
            $maxLevel = $maxLevel > 9  ? 9 : $maxLevel;

            $selected_proyectosTRL = [];
            try{
                $query_proyectosTRL = $this->db->connect()->prepare(
                    'SELECT nivel, COUNT(nivel) as total FROM (
                    SELECT tecnologia_idtecnologia, max(nivel) as nivel from evaluaciontrl
                    GROUP BY tecnologia_idtecnologia) as nivelMaximoXTecnologia
                    WHERE nivel BETWEEN :minLevel AND :maxLevel
                    GROUP BY nivel;');//TODO Zury Query
                $query_proyectosTRL->execute([
                    'minLevel' =>  $minLevel,
                    'maxLevel' =>  $maxLevel
                    ]);
                while($row_proyectosTRL = $query_proyectosTRL->fetch()){
                    $proyectosTRL=array();
                    $proyectosTRL['label'] = $row_proyectosTRL['nivel'];
                    $proyectosTRL['value'] = $row_proyectosTRL['total'];
                    array_push($selected_proyectosTRL, $proyectosTRL);
                }
                return $selected_proyectosTRL;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }

        public function getChartAreaAcademica($argumentos){
            
            /*
            top de Áreas academicas con más usuarios
                -----------------------
                Para top 10
                    getChartAreaAcademica([])
                ------------------------
                Para top personalizado
                    getChartAreaAcademica([
                        'limitBy' =>  5
                        ]);
                -----------------------
            */

            //validación de argumentos
            $limit = !isset($argumentos['limitBy']) ? 5 : $argumentos['limitBy'];
            $limit = $limit < 1  ? 1 : $limit;

            $selected_areas_academicas = [];
            try{
                $query_areas_academicas = $this->db->connect()->prepare(
                    'SELECT campo_de_conocimiento, count(idcampo_de_conocimiento) AS cantidad FROM campo_de_conocimiento
                INNER JOIN disciplina ON (idcampo_de_conocimiento=campo_conocimiento_idcampo_conocimiento)
                INNER JOIN subdisciplina ON (iddisciplina = disciplina_iddisciplina)
                INNER JOIN perfil_academico ON (idsubdisciplina=subdisciplina_idsubdisciplina)
                GROUP BY idcampo_de_conocimiento
                ORDER BY cantidad
                LIMIT :limitBy;');//TODO Zury query
                $query_areas_academicas->execute([
                    'limitBy' =>  $limit
                    ]);
                while($row_areas_academicas = $query_areas_academicas->fetch()){
                    $areas_academicas=array();
                    $areas_academicas['label'] = $row_areas_academicas['campo_de_conocimiento'];
                    $areas_academicas['value'] = $row_areas_academicas['cantidad'];
                    array_push($selected_areas_academicas, $areas_academicas);
                }
                return $selected_areas_academicas;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
            
        }
        
        public function getChartSectorIndustrial($argumentos){

            $limit = !isset($argumentos['limit']) ? 5 : $argumentos['limit'];
            $limit = $limit < 1  ? 1 : $limit;

            $selected_sector_industrial = [];
            try{
                $query_sector_industrial = $this->db->connect()->prepare(
                    'SELECT sector_scian, count(idsector_scian) AS cantidad FROM tecnologia_has_rama_scian
                INNER JOIN rama_scian ON rama_scian_idrama_scian= idrama_scian
                INNER JOIN subsector_scian ON subsector_scian_idsubsector_scian=idsubsector_scian
                INNER JOIN sector_scian ON sector_scian_idsector_scian=idsector_scian
                GROUP BY idsector_scian
                ORDER BY cantidad DESC
                LIMIT :limitBy;');//TODO Zury query
                $query_sector_industrial->execute([
                    'limitBy' =>  $limit
                    ]);
                while($row_sector_industrial = $query_sector_industrial->fetch()){
                    $sector_industrial=array();
                    $sector_industrial['label'] = $row_sector_industrial['sector_scian'];
                    $sector_industrial['value'] = $row_sector_industrial['cantidad'];
                    array_push($selected_sector_industrial, $sector_industrial);
                }
                return $selected_sector_industrial;
            }catch(PDOException $e){
                //echo e;
                return [];
            }

        }

        public function getChartEstados($argumentos = 10){
            
            // top 10 de estados con mas usuarios
            $limit = !isset($argumentos['limit']) ? 10 : $argumentos['limit'];
            $limit = $limit < 1  ? 1 : $limit;

            $selected_estado = [];
            try{
                $query_estado = $this->db->connect()->prepare('');//TODO Zury query
                $query_estado->execute([
                    'limitBy' =>  $limit
                    ]);
                while($row_estado = $query_estado->fetch()){
                    $estado=array();
                    $estado['label'] = $row_users['estado'];
                    $estado['value'] = $row_users['total'];
                    array_push($selected_estado, $estado);
                }
                return $selected_estado;
            }catch(PDOException $e){
                //echo e;
                return [];
            }

        }

        public function getChartObjetivosONU($argumentos){
            
            //top 10 de Objetivo de la ONU con mas usuarios
            $limit = !isset($argumentos['limit']) ? 5 : $argumentos['limit'];
            $limit = $limit < 1  ? 1 : $limit;

            $selected_objetivo_onu = [];
            try{
                $query_objetivo_onu = $this->db->connect()->prepare(
                    'SELECT objetivo_sotenible_onu, count(idobjetivo_sotenible_onu) AS cantidad FROM objetivo_sotenible_onu
                INNER JOIN tecnologia_has_objetivo_sotenible_onu ON (idobjetivo_sotenible_onu=objetivo_sotenible_onu_idobjetivo_sotenible_onu)
                GROUP BY idobjetivo_sotenible_onu
                ORDER BY cantidad DESC
                LIMIT :limitBy;');//TODO Zury query
                $query_objetivo_onu->execute([
                    'limitBy' =>  $limit
                    ]);
                while($row_objetivo_onu = $query_objetivo_onu->fetch()){
                    $objetivo_onu=array();
                    $objetivo_onu['label'] = $row_objetivo_onu['objetivo_sotenible_onu'];
                    $objetivo_onu['value'] = $row_objetivo_onu['cantidad'];
                    array_push($selected_objetivo_onu, $objetivo_onu);
                }
                return $selected_objetivo_onu;
            }catch(PDOException $e){
                //echo e;
                return [];
            }

        }

        public function getChartApoyos(){
            
            // Usuarios con apoyos ( beca/cátedras/sni)
            $limit = !isset($argumentos['limit']) ? 10 : $argumentos['limit'];
            $limit = $limit < 1  ? 1 : $limit;

            $selected_apoyo = [];
            try{
                $query_apoyo = $this->db->connect()->prepare('');//TODO Zury query
                $query_apoyo->execute([
                    'limitBy' =>  $limit
                    ]);
                while($row_apoyo = $query_apoyo->fetch()){
                    $apoyo=array();
                    $apoyo['label'] = $row_users['apoyo'];
                    $apoyo['value'] = $row_users['total'];
                    array_push($selected_apoyo, $apoyo);
                }
                return $selected_apoyo;
            }catch(PDOException $e){
                //echo e;
                return [];
            }

        }

        public function getChartNivelesAcademicos(){
            
            //usuarios por Niveles academicos
            $limit = !isset($argumentos['limit']) ? 10 : $argumentos['limit'];
            $limit = $limit < 1  ? 1 : $limit;

            $selected_nivel_academico = [];
            try{
                $query_nivel_academico = $this->db->connect()->prepare('');//TODO Zury query
                $query_nivel_academico->execute([
                    'limitBy' =>  $limit
                    ]);
                while($row_nivel_academico = $query_nivel_academico->fetch()){
                    $nivel_academico=array();
                    $nivel_academico['label'] = $row_users['nivel_academico'];
                    $nivel_academico['value'] = $row_users['total'];
                    array_push($selected_nivel_academico, $nivel_academico);
                }
                return $selected_nivel_academico;
            }catch(PDOException $e){
                //echo e;
                return [];
            }

        }

        public function getChartTipoSoluciones($argumentos){
            
            //top 10 de Tipos de soluciones ( procesos, producto, servicios, etc) con mas usuarios
            $limit = !isset($argumentos['limit']) ? 5 : $argumentos['limit'];
            $limit = $limit < 1  ? 1 : $limit;

            $selected_solucion = [];
            try{
                $query_solucion = $this->db->connect()->prepare(
                    'SELECT tipo_tecnologia, count(idtipo_tecnologia) AS cantidad FROM tipo_tecnologia
                INNER JOIN manera_solucionar ON (idtipo_tecnologia= tipo_tecnologia_idtipo_tecnologia)
                GROUP BY idtipo_tecnologia
                ORDER BY cantidad DESC
                LIMIT :limitBy;');//TODO Zury query
                $query_solucion->execute([
                    'limitBy' =>  $limit
                    ]);
                while($row_solucion = $query_solucion->fetch()){
                    $solucion=array();
                    $solucion['label'] = $row_solucion['tipo_tecnologia'];
                    $solucion['value'] = $row_solucion['cantidad'];
                    array_push($selected_solucion, $solucion);
                }
                return $selected_solucion;
            }catch(PDOException $e){
                //echo e;
                return [];
            }

        }

        public function getChartTipoColaboraciones($argumentos){
            
            //top 10 de Tipo de colaboración con mas usuarios
            $limit = !isset($argumentos['limit']) ? 5 : $argumentos['limit'];
            $limit = $limit < 1  ? 1 : $limit;

            $selected_colaboracion = [];
            try{
                $query_colaboracion = $this->db->connect()->prepare(
                    'SELECT tipo_alianza, count(idtipo_alianza) AS cantidad FROM tipo_alianza
                INNER JOIN tecnologia ON (idtipo_alianza=tipo_alianza_idtipo_alianza)
                GROUP BY idtipo_alianza
                ORDER BY cantidad DESC
                LIMIT :limitBy;');//TODO Zury query
                $query_colaboracion->execute([
                    'limitBy' =>  $limit
                    ]);
                while($row_colaboracion = $query_colaboracion->fetch()){
                    $colaboracion=array();
                    $colaboracion['label'] = $row_colaboracion['tipo_alianza'];
                    $colaboracion['value'] = $row_colaboracion['cantidad'];
                    array_push($selected_colaboracion, $colaboracion);
                }
                return $selected_colaboracion;
            }catch(PDOException $e){
                //echo e;
                return [];
            }

        }

    }
?>