<?php

include_once 'user_session.php';

    class LoginModel extends Model
    {
        private $id;
        private $username;
        private $usertype;
        private $profileID;

        public function __construct(){
            parent::__construct();
            $this->userSession = new UserSession();
        }

        public function userExists($user, $pass){
            $query = $this->db->connect()->prepare(
                //"SELECT `idUsuario` FROM `usuario` WHERE `username` = :user AND `pass`= AES_ENCRYPT(:pass, :secreto);"
                "SELECT
                    `idusuario_general`
                FROM
                    `usuario_general`
                WHERE
                    `correo` = :user AND `password` = AES_ENCRYPT(:pass, :secreto)"
            );
            $query->execute(['user' => $user, 'pass' => $pass, 'secreto' => constant('SECRET')]);
            if($query->rowCount()){
                return true;
            }else{
                return false;
            }
        }

        public function setId($user, $pass){
            $query = $this->db->connect()->prepare(
                "SELECT
                    `idusuario_general`,
                    `nombre`,
                    `apellido_paterno`,
                    `apellido_materno`,
                    `tipo_usuario_idtipo_usuario`
                FROM
                    `usuario_general`
                WHERE
                    `correo` = :user AND `password` = AES_ENCRYPT(:pass, :secreto)"
            );
            $query->execute(['user' => $user, 'pass' => $pass, 'secreto' => constant('SECRET')]);
            
            foreach ($query as $currentUser) {
                $this->id = $currentUser['idusuario_general'];
                $this->usertype = $currentUser['tipo_usuario_idtipo_usuario'];
                $this->username = $currentUser['nombre'].' '.$currentUser['apellido_paterno'];
            }
            if($this->usertype == 1){
                $this->profileID = $this->getIndustryProfileID();
            }
            if($this->usertype == 2){
                $this->profileID = $this->getAcademicProfileID();
            }
            
            $this->userSession->setCurrentUserData($this->id,$this->username,$this->usertype,$this->profileID);

        }

        public function getAcademicProfileID(){
            try{
                $query_profile = $this->db->connect()->prepare('SELECT `idperfil_academico` FROM `perfil_academico` WHERE `usuario_general_idusuario_general`= :userID');
                $query_profile->execute(['userID' => $this->id]);
                
                if($query_profile->rowCount()==1){
                    $row_profile = $query_profile->fetch();
                    return $row_profile['idperfil_academico'];
                }else{
                    return null;
                }
            }catch(PDOException $e){
                //echo e;
                return null;
            }
        }

        public function getIndustryProfileID(){
            try{
                $query_profile = $this->db->connect()->prepare('SELECT `idperfil_empresario` FROM `perfil_empresario` WHERE `usuario_general_idusuario_general`= :userID');
                $query_profile->execute(['userID' => $this->id]);
                
                if($query_profile->rowCount()==1){
                    $row_profile = $query_profile->fetch();
                    return $row_profile['idperfil_empresario'];
                }else{
                    return null;
                }
            }catch(PDOException $e){
                //echo e;
                return null;
            }
        }

        public function logout(){
            $this->userSession->closeSession();
        }
    }

?>