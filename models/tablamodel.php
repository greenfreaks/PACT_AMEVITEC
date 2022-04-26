<?php
class tablaModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    // public function getAllInstituciones(){
    //     try{
    //         $queryGetInstituciones = $this->db->connect()->prepare(
    //             "SELECT * FROM uci_instituciones ins");
    //         $result = mysqli_num_rows($queryGetInstituciones);
    //         if($result > 0){
    //             while ($data = mysqli_fetch_array($queryGetInstituciones)){
    //                 echo $data["nombre_institucion"];
    //             }
    //         }
    //     }catch(PDOException $e){
    //         return $e;
    //     }
    // }//End method getAllInstituciones()

    public function getAllInstituciones(){
        $instituciones_info = [];
        try{
            $queryGetInstituciones = $this->db->connect()->prepare(
                "SELECT * FROM uci_instituciones ins");
            $result = mysqli_num_rows($queryGetInstituciones);
                while ($data = $queryGetInstituciones->fetch()){
                    $institucionesArray = array();
                    $institucionesArray['id_institucion'] = $data['id_institucion'];
            }
        }catch(PDOException $e){
            return $e;
        }
    }//End method getAllInstituciones()

} // End class tablaModel
?>