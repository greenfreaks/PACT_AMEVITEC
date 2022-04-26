<?php

    class NewtechModel extends Model{

        public function __construct(){
            parent::__construct();
        }

        public function getProblematicas(){
            $selected_problematicas = [];
            try{
                $query_problematicas = $this->db->connect()->query('SELECT `idtipo_problematica`,`idtipo_problematica`  FROM tipo_problematica;');
                while($row_problematicas = $query_problematicas->fetch()){
                    $problematica=array();
                    $problematica['id'] = $row_problematicas['idtipo_problematica'];
                    $problematica['value'] = $row_problematicas['idtipo_problematica'];
                    array_push($selected_problematicas, $problematicas);
                }
                return $selected_problematicas;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }

        public function getTipoTecnologia(){
            $selected_tipo_tecnologia = [];
            try{
                $query_tipo_tecnologia = $this->db->connect()->query('SELECT `idtipo_tecnologia`,`tipo_tecnologia` FROM tipo_tecnologia;');
                while($row_tipo_tecnologia = $query_tipo_tecnologia->fetch()){
                    $tipo_tecnologia=array();
                    $tipo_tecnologia['id'] = $row_tipo_tecnologia['idtipo_tecnologia'];
                    $tipo_tecnologia['val'] = $row_tipo_tecnologia['tipo_tecnologia'];
                    array_push($selected_tipo_tecnologia, $tipo_tecnologia);
                }
                return $selected_tipo_tecnologia;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }

        public function getVerbos(){
            $selected = [];
            try{
                $query = $this->db->connect()->query('SELECT `idverbo_solucion`,`verbo_solucion` FROM verbo_solucion;');
                while($row = $query->fetch()){
                    $verbo=array();
                    $verbo['id'] = $row['idverbo_solucion'];
                    $verbo['val'] = $row['verbo_solucion'];
                    array_push($selected, $verbo);
                }
                return $selected;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }

        public function getTipoUsuario(){
            $selected_tipo_usuario = [];
            try{
                $query_tipo_usuario = $this->db->connect()->query('SELECT `idusuario_tecnologia`,`usuario_tecnologia` FROM usuario_tecnologia;');
                while($row_tipo_usuario = $query_tipo_usuario->fetch()){
                    $tipo_usuario=array();
                    $tipo_usuario['id'] = $row_tipo_usuario['idusuario_tecnologia'];
                    $tipo_usuario['val'] = $row_tipo_usuario['usuario_tecnologia'];
                    array_push($selected_tipo_usuario, $tipo_usuario);
                }
                return $selected_tipo_usuario;
            }catch(PDOException $e){
                //echo $e;
                return [];
            }
        }

        public function getObjetivosONU(){
            $selected_objetivos = [];
            try{
                $query_objetivos = $this->db->connect()->query('SELECT `idobjetivo_sotenible_onu`, `objetivo_sotenible_onu`, `color` FROM `objetivo_sotenible_onu` WHERE 1');
                while($row_objetivo = $query_objetivos->fetch()){
                    $objetivo=array();
                    $objetivo['id'] = $row_objetivo['idobjetivo_sotenible_onu'];
                    $objetivo['objetivo'] = $row_objetivo['objetivo_sotenible_onu'];
                    $objetivo['color'] = $row_objetivo['color'];
                    array_push($selected_objetivos, $objetivo);
                }
                return $selected_objetivos;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }

        public function insertProject($data){
            $insert_project = $this->db->connect();
            //insertar
            $query_project = $insert_project->prepare(
            'INSERT INTO `tecnologia` (`usuario_general_idusuario_general`, `nombre`, `tipo_alianza_idtipo_alianza`) VALUES (:idusuario, :techname, :alianzaID);');
            try{
                $query_project->execute([
                    'idusuario' => $data['idusuario'],
                    'techname' => $data['techname'],
                    'alianzaID' => $data['alianzaID']
                ]);
                return $insert_project->lastInsertId();
            }catch(PDOException $e){
                //echo $e;
                //print_r $data;
                return null;
            }
        }

        public function insertProblematica($data){
            $insert_problematica = $this->db->connect();
            //insertar
            $query_problematica = $insert_problematica->prepare(
            'INSERT INTO `tecnologia_has_tipo_problematica` (`tecnologia_idtecnologia`, `tipo_problematica_idtipo_problematica`) VALUES (:idTecnologia, :problematica);');
            try{
                $query_problematica->execute([
                    'idTecnologia' => $data['idTecnologia'],
                    'problematica' => $data['problematica']
                ]);
                return $insert_problematica->lastInsertId();
            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertSector($data){
            $insert_sector = $this->db->connect();
            $query_sector = $insert_sector->prepare(
            'INSERT INTO `tecnologia_has_rama_scian` (`tecnologia_idtecnologia`, `rama_scian_idrama_scian`) VALUES (:idTecnologia, :idrama);');
            try{
                $query_sector->execute([
                    'idTecnologia' => $data['idTecnologia'],
                    'idrama' => $data['idrama']
                ]);
                return $insert_sector->lastInsertId();
            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertPredicado($data){
            $insert_predicado = $this->db->connect();
            //insertar
            $query_predicado = $insert_predicado->prepare(
            'INSERT INTO `manera_solucionar` (`tecnologia_idtecnologia`, `tipo_tecnologia_idtipo_tecnologia`, `verbo_solucion_idverbo_solucion`, `complemento`, `usuario_tecnologia_idusuario_tecnologia`) VALUES (:tecnologiaID, :idtecnologia, :idverbo, :complemento, :idusuario);');
            try{
                $query_predicado->execute([
                    'tecnologiaID' => $data['tecnologiaID'],
                    'idtecnologia' => $data['idtecnologia'],
                    'idusuario' => $data['idusuario'],
                    'idverbo' => $data['idverbo'],
                    'complemento' => $data['complemento']
                ]);
                return $insert_predicado->lastInsertId();
            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertObjetivo($data){
            $insert_objetivo = $this->db->connect();
            //insertar
            $query_objetivo = $insert_objetivo->prepare(
            'INSERT INTO `tecnologia_has_objetivo_sotenible_onu` (`tecnologia_idtecnologia`, `objetivo_sotenible_onu_idobjetivo_sotenible_onu`) VALUES (:tecnologiaID, :objetivo);');
            try{
                $query_objetivo->execute([
                    'tecnologiaID' => $data['tecnologiaID'],
                    'objetivo' => $data['objetivo'],
                ]);
                return $insert_objetivo->lastInsertId();
            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

    }

?>