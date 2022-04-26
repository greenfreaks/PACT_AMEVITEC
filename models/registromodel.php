<?php

    class RegistroModel extends Model
    {

        public function __construct(){
            parent::__construct();  
        }

        public function userExists($email){

            $query_email = $this->db->connect()->prepare('SELECT idusuario_general FROM `usuario_general` WHERE correo = :email;');
            $query_email->execute(['email' => $email]);

            if($query_email->rowCount()){
                return true;
            }else{
                return false;
            }

        }

        public function registroUsuarioGeneral($data, $usertype){

            $insert = $this->db->connect();
            // insertar
            $query = $insert->prepare(
            'INSERT INTO `usuario_general`(
                `nombre`,
                `apellido_paterno`,
                `apellido_materno`,
                `correo`,
                `municipio_idmunicipio`,
                `tipo_usuario_idtipo_usuario`,
                `password`,
                `fecha_nacimiento`,
                `celular`,
                `genero`
            )
            VALUES(
                :nombres,
                :apellidoPaterno,
                :apellidoMaterno,
                :email,
                :idmunicipio,
                :usertype,
                AES_ENCRYPT(
                    :password,
                    :secret
                ),
                :fechaNacimiento,
                :telefono,
                0
            );');
            try{
                $query->execute([
                    'nombres' => $data['nombre'],
                    'apellidoPaterno' => $data['apeidoP'],
                    'apellidoMaterno' => $data['apeidoM'],
                    'email' => $data['email'],
                    'idmunicipio' => $data['municipio'],
                    'usertype' => $usertype,
                    'password' => $data['pass'],
                    'secret' => constant('SECRET'),
                    'fechaNacimiento' => $data['fecha_nacimiento'],
                    'telefono' => $data['telefono']
                ]);

                return $insert->lastInsertId();

            }catch(PDOException $e){

                //echo $e;
                //echo 'fecha_nacimiento:('.$data['fecha_nacimiento'].')';
                return null;

            }

        }

        public function registroPerfilAcademico($userID,$data){

            $insert = $this->db->connect();
            // insertar
            $query = $insert->prepare(
                'INSERT INTO `perfil_academico`(
                    `usuario_general_idusuario_general`,
                    `grado_academico_idgrado_academico`,
                    `escuela`,
                    `subdisciplina_idsubdisciplina`,
                    `estudios_actuales`,
                    `estimulo_beca_idestimulo_beca`,
                    `organizacion_actual`,
                    `funcion_academico_idfuncion_academico`,
                    `titulo_obtenido`,
                    `fecha_egreso`
                )
                VALUES(
                    :idUsuario,
                    :grado_academico,
                    :escuela,
                    :subdisciplina,
                    :actualmente_estudiando,
                    :estimulo,
                    :organizacion_actual,
                    :funcion,
                   :titulo,
                    :fecha_egreso
                );');
            try{
                $query->execute([
                    'idUsuario' => $userID,
                    'grado_academico' => $data['grado_academico'],
                    'escuela' => $data['escuela'],
                    'subdisciplina' => $data['subdisciplina'],
                    'actualmente_estudiando' => $data['actualmente_estudiando'],
                    'estimulo' => $data['estimulo'],
                    'organizacion_actual' => $data['organizacion_actual'],
                    'funcion' => $data['funcion'],
                    'titulo' => $data['titulo'],
                    'fecha_egreso' => $data['fecha_egreso']
                ]);

                return $insert->lastInsertId();

            }catch(PDOException $e){

                return null;

            }

        }

        public function insertActividad($idPerfilAcademico , $exp){

            $insert_exp = $this->db->connect();
            //insertar
            $query_exp = $insert_exp->prepare(
            'INSERT INTO `perfil_academico_has_actividad_experiencia`(
                `perfil_academico_idperfil_academico`,
                `actividad_experiencia_idactividad_experiencia`
            )
            VALUES(:perfil, :experiencia);');

            try{
                $query_exp->execute([
                    'perfil' => $idPerfilAcademico,
                    'experiencia' => $exp
                ]);
                return $insert_exp->lastInsertId();

            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertOrganizacion($idPerfilAcademico , $value){

            $insert = $this->db->connect();
            //insertar
            $query = $insert->prepare(
                'INSERT INTO `organizaciones_experiencia` (`organizacion_idorganizacion`, `perfil_academico_idperfil_academico`) VALUES ( :val, :perfil);'
            );

            try{
                $query->execute([
                    'perfil' => $idPerfilAcademico,
                    'val' => $value
                ]);
                return $insert->lastInsertId();

            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertDesarrollo($idPerfilAcademico , $value){

            $insert = $this->db->connect();
            //insertar
            $query = $insert->prepare(
                'INSERT INTO `perfil_academico_has_actividad_desarrollo` (`perfil_academico_idperfil_academico`, `actividad_desarrollo_idactividad_desarrollo`) VALUES ( :perfil, :val);'
            );

            try{
                $query->execute([
                    'perfil' => $idPerfilAcademico,
                    'val' => $value
                ]);
                return $insert->lastInsertId();

            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertLugarDesarrollo($idPerfilAcademico , $value){

            $insert = $this->db->connect();

            $query = $insert->prepare(
                'INSERT INTO `perfil_academico_has_lugar_desarrollo` (`perfil_academico_idperfil_academico`, `lugar_desarrollo_idlugar_desarrollo`) VALUES ( :perfil, :val);'
            );

            try{
                $query->execute([
                    'perfil' => $idPerfilAcademico,
                    'val' => $value
                ]);
                return $insert->lastInsertId();

            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertHabilidadAdquirida($idPerfilAcademico , $value){

            $insert = $this->db->connect();

            $query = $insert->prepare(
                'INSERT INTO `perfil_academico_has_habilidad_adquirida` (`perfil_academico_idperfil_academico`, `habilidad_adquirida_idhabilidad_adquirida`) VALUES ( :perfil, :val);'
            );

            try{
                $query->execute([
                    'perfil' => $idPerfilAcademico,
                    'val' => $value
                ]);
                return $insert->lastInsertId();

            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertHabilidadCompetencia($idPerfilAcademico , $value){

            $insert = $this->db->connect();

            $query = $insert->prepare(
                'INSERT INTO `perfil_academico_has_habilidad_competencia` (`perfil_academico_idperfil_academico`, `habilidad_competencia_idhabilidad_compentencia`) VALUES ( :perfil, :val);'
            );

            try{
                $query->execute([
                    'perfil' => $idPerfilAcademico,
                    'val' => $value
                ]);

            return $insert->lastInsertId();

            }catch(PDOException $e){
                throw $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function insertTalento($idPerfilAcademico,$value){
            $insert = $this->db->connect();

            $query = $insert->prepare(
                'INSERT INTO `perfil_academico_has_actividad_talento`(`perfil_academico_idperfil_academico`, `actividad_talento_idactividad_talento`) VALUES (:perfil,:val);'
            );

            try{
                $query->execute([
                    'perfil' => $idPerfilAcademico,
                    'val' => $value
                ]);

            return $insert->lastInsertId();

            }catch(PDOException $e){
                throw $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

        public function registroPerfilEmpresario($userID,$data){

            $insert_empresario = $this->db->connect();
            //insertar
            $query_empresario = $insert_empresario->prepare(
            'INSERT INTO `perfil_empresario`(
                `usuario_general_idusuario_general`,
                `nombre_empresa`,
                `puesto_empresa_idpuesto_empresa`,
                `pagina_web`,
                `presencia_mercado_idpresencia_mercado`,
                `rama_scian_idrama_scian`,
                `size_empresa_idsize_empresa`
            )
            VALUES(
                :userID,
                :nombre_empresa,  
                :puesto,  
                :pagina_web,  
                :presencia_mercado,  
                :rama,  
                :tamano 
            );');
            try{
                $query_empresario->execute([
                    'userID' => $userID,
                    'nombre_empresa' => $data['nombre_empresa'],
                    'puesto' => $data['puesto'],
                    'pagina_web' => $data['pagina_web'],
                    'presencia_mercado' => $data['presencia_mercado'],
                    'rama' => $data['rama_scian'],
                    'tamano' => $data['tamano'],
                ]);
                return $insert_empresario->lastInsertId();
            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return null;
            }
        }

    }
        
?>