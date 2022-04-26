<?php

    class RecoveryModel extends Model{

        public function __construct(){
            parent::__construct();
        }

        public function userExists($user){
            $query = $this->db->connect()->prepare(
                "SELECT
                    `correo`
                FROM
                    `usuario_general`
                WHERE
                    `correo` = :user"
            );

            $query->execute(['user' => $user]);

            if($query->rowCount()){
                return true;
            }else{
                return false;
            }
        }

        public function getUserID($user){

            $query = $this->db->connect()->prepare(
                "SELECT
                    `idusuario_general`
                FROM
                    `usuario_general`
                WHERE
                    `correo` = :user"
            );

            $query->execute(['user' => $user]);

            if($query->rowCount()== 1){
                $row = $query->fetch();
                return $row['idusuario_general'];
            }else{
                return null;
            }

        }

        public function sendCode($code,$userID){

            $insert_code = $this->db->connect();
            //insertar
            $query_code = $insert_code->prepare(
            'INSERT INTO `password_recovery`(
                `codigo_verificacion`,
                `usuario_general_idusuario_general`
            )
            VALUES(
                :codigo,
                :userID
            );');
            try{
                $query_code->execute([
                    'codigo' => $code,
                    'userID' => $userID
                ]);
                return $insert_code->lastInsertId();
            }catch(PDOException $e){
                return null;
            }
        }

        public function vefifyCode($user,$code){

            try{
                $query_code = $this->db->connect()->prepare('SELECT `idpassword_recovery` FROM `password_recovery` WHERE `codigo_verificacion` = :code AND `usuario_general_idusuario_general` = :userID AND `uso_codigo` = 0;'  );

                $query_code->execute(['code' => $code, 'userID' => $this->getUserID($user)]);

                if($query_code->rowCount() == 1 ){
                    return true;
                }else{
                    return false;
                }
                
            }catch(PDOException $e){
                //echo $e;
                //echo "`codigo_verificacion` = {$code} AND `usuario_general_idusuario_general` = {$this->getUserID($user)}";
                return false;
            }
            
        }

        public function changePass($userID,$pass){
            $update_pass = $this->db->connect();
            //insertar
            $query_pass = $update_pass->prepare(
            'UPDATE `usuario_general` SET `password`=AES_ENCRYPT(:pass,:secreto) WHERE `idusuario_general`=:userID;');
            try{
                $query_pass->execute([
                    'pass' => $pass,
                    'userID' => $userID,
                    'secreto' => constant('SECRET')
                ]);
                return true;
            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return false;
            }
        }

        public function cleanCodes($userID){

            $update_code = $this->db->connect();
            //insertar
            $query_code = $update_code->prepare(
            'UPDATE `password_recovery` SET `uso_codigo`=1 WHERE `usuario_general_idusuario_general`= :userID;');
            try{
                $query_code->execute([
                    'userID' => $userID
                ]);
                return true;
            }catch(PDOException $e){
                //echo $e;
                //echo 'data:('.$data['data'].')';
                return false;
            }

        }

        
    }

?>