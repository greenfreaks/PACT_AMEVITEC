<?php

    class LicenciasModel extends Model{

        public function __construct(){
            parent::__construct();
        }

        public function insertLicenceEmail($email){

            $insert_licence = $this->db->connect();
            //insertar
            $query_licence = $insert_licence->prepare(
            'INSERT INTO `licencia_reporte_trl` (`correo`) VALUES (:email);');
            try{
                $query_licence->execute([
                    'email' => $email
                ]);
                return $insert_licence->lastInsertId();
            }catch(PDOException $e){
                $insert_licence->rollback();
                throw $e;
                return null;
                //echo 'data:('.$data['data'].')';
            }
        }

        public function insertSerial($idlicencia_reporte_trl , $serial){
            $insert_serial = $this->db->connect();
            //insertar
            $query_serial = $insert_serial->prepare(
            'INSERT INTO `codigo_reportetrl` (`licencia_reporte_trl_idlicencia_reporte_trl`, `codigo_reporteTrl`) VALUES (:idlicencia, :serialCode);');
            try{
                $query_serial->execute([
                    'idlicencia' => $idlicencia_reporte_trl,
                    'serialCode' => $serial
                ]);
                return $insert_serial->lastInsertId();
            }catch(PDOException $e){
                $insert_serial->rollback();
                throw $e;
                return null;
                //echo 'data:('.$data['data'].')';
            }
        }

        public function selectEmpresario($email){
            $selected_users = [];
            try{
                $query_users = $this->db->connect()->prepare(
                    'SELECT
                    `idusuario_general`,
                    `nombre`,
                    `apellido_paterno`,
                    `apellido_materno`,
                    perfil_empresario.nombre_empresa
                FROM
                    `usuario_general`
                INNER JOIN perfil_empresario on usuario_general.idusuario_general = perfil_empresario.usuario_general_idusuario_general
                WHERE
                    `tipo_usuario_idtipo_usuario` = 1 AND `correo`= :email');
                $query_users->execute(['email' => $email]);
                while($row_users = $query_users->fetch()){
                    $users=array();
                    $users['id'] = $row_users['idusuario_general'];
                    $users['empresa'] = $row_users['nombre_empresa'];
                    $users['nombre'] = $row_users['nombre'].' '.$row_users['apellido_paterno'].' '.$row_users['apellido_materno'];
                    $users['numLicencias'] = $this->numberLicencias($row_users['idusuario_general']);
                    $users['licenciasUsadas'] = $this->licenciasUsadas($row_users['idusuario_general']);
                    array_push($selected_users, $users);
                }
                return $selected_users;
            }catch(PDOException $e){
                //echo e;
                return [];
            }
        }

        public function insertEmpresario($correo , $idEmpresario){
            $insert_empresario = $this->db->connect();
            //insertar
            $query_empresario = $insert_empresario->prepare(
            'INSERT INTO `licencia_reporte_trl` (`correo`,`perfil_empresario_idperfil_empresario`) VALUES (:correo,:idEmpresario);');
            try{
                $query_empresario->execute([
                    'correo' => $correo,
                    'idEmpresario' => $idEmpresario
                ]);
                return $insert_empresario->lastInsertId();
            }catch(PDOException $e){
                $insert_empresario->rollback();
                throw $e;
                return null;
                //echo 'data:('.$data['data'].')';
            }
        }

        public function numberLicencias($empresario_ID){
            $selected_total = [];
            try{
                $query_total = $this->db->connect()->prepare(
                    'SELECT count(`idcodigo_reporteTrl`) as numLicencias FROM `codigo_reportetrl` 
                    INNER JOIN `licencia_reporte_trl` 
                    ON (`licencia_reporte_trl_idlicencia_reporte_trl`=`idlicencia_reporte_trl`)
                    WHERE  `perfil_empresario_idperfil_empresario`=:ideEmpresario;');
                $query_total->execute([
                    'ideEmpresario' => $empresario_ID
                    ]);
                if($query_total->rowCount()==1){
                    $row_total = $query_total->fetch();
                    $selected_total ['numLicencias'] = $row_total['numLicencias'];
                }
                return $selected_total ['numLicencias'];
            }catch(PDOException $e){
                //echo $e;
                return null;
            }
        }

        public function licenciasUsadas($empresario_ID){
            $selected_total = [];
            try{
                $query_total = $this->db->connect()->prepare(
                    ' SELECT count(`idcodigo_reporteTrl`) as numLicencias FROM `codigo_reportetrl` 
                    INNER JOIN `licencia_reporte_trl` 
                    ON (`licencia_reporte_trl_idlicencia_reporte_trl`=`idlicencia_reporte_trl`)
                    WHERE  `perfil_empresario_idperfil_empresario`=:ideEmpresario and `evaluacionTrl_idevaluacionTrl`> 0;');
                $query_total->execute([
                    'ideEmpresario' => $empresario_ID
                    ]);
                if($query_total->rowCount()==1){
                    $row_total = $query_total->fetch();
                    $selected_total ['numLicencias'] = $row_total['numLicencias'];
                }
                return $selected_total ['numLicencias'];
            }catch(PDOException $e){
                //echo $e;
                return null;
            }
        }
    }

?>