<?php
class registroPropiedadIntelectualmodel extends Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function isTechOfUser($techID){
        try{
            $query_owner = $this->db->connect()->prepare('SELECT `nombre` FROM `tecnologia` WHERE `idtecnologia`= :techid AND `usuario_general_idusuario_general`= :userID;');
            $query_owner->execute([
                'techid' => $techID,
                'userID' => $_SESSION['userId']
                ]);
            if($query_owner->rowCount()==1){
                return true;
            }
            return false;
        }catch(PDOException $e){
            //echo $e;
            return false;
        }
    }

    function getSectoresIndustrialesModel(){
        $allSectoresIndustriales=[];
        try{
            $querySectores = $this->db->connect()->prepare("SELECT * FROM uci_industria_labs");
            $querySectores->execute();
            while($rowSectores = $querySectores->fetch()){
               $sector = array();
               $sector['id_industria'] = $rowSectores['id_industria'];
               $sector['nombre_industria'] = $rowSectores['nombre_industria'];

               array_push($allSectoresIndustriales, $sector);
            }
            return $allSectoresIndustriales;
        }catch(PDOException $e){
            return[];
        }
    }
}//End model
?>