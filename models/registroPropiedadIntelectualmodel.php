<?php
class registroPropiedadIntelectualModel extends Model{
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
    } //End function

    // Obtener Todos los sectores

    function getAllSectoresModel(){
        $allSectoresIndustriales=[];
        try{
            $querySectores = $this->db->connect()->prepare("SELECT * FROM sector_scian");
            $querySectores->execute();
            while($rowSectores = $querySectores->fetch()){
               $sectores = array();
               $sectores['idsector_scian'] = $rowSectores['idsector_scian'];
               $sectores['sector_scian'] = $rowSectores['sector_scian'];

               array_push($allSectoresIndustriales, $sectores);
            }
            return $allSectoresIndustriales;
        }catch(PDOException $e){
            return[];
        }
    } //End function

    // Obtener Tipos de Propiedad Intelectual.

    function getAllTipoPropiedadModel(){
        $allTipoPropiedad=[];
        try{
            $queryTipoPropiedad = $this->db->connect()->prepare("SELECT * FROM tec_tipo_propiedad_intelectual");
            $queryTipoPropiedad->execute();
            while($rowTipoPropiedad = $queryTipoPropiedad->fetch()){
               $tipoPropiedad = array();
               $tipoPropiedad['id_tipoPropiedadIntelectual'] = $rowTipoPropiedad['id_tipoPropiedadIntelectual'];
               $tipoPropiedad['nombre_tipoPropiedadIntelectual'] = $rowTipoPropiedad['nombre_tipoPropiedadIntelectual'];

               array_push($allTipoPropiedad, $tipoPropiedad);
            }
            return $allTipoPropiedad;
        }catch(PDOException $e){
            return[];
        }
    } //End function

    // Obtener Estatus de Propiedad Intelectual.

    function getEstatusPropiedadModel(){
        $estatusPropiedad=[];
        try{
            $queryEstatusPropiedad = $this->db->connect()->prepare("SELECT * FROM tec_propiedad_intelectual_estatus");
            $queryEstatusPropiedad->execute();
            while($rowEstatusPropiedad = $queryEstatusPropiedad->fetch()){
               $estatus = array();
               $estatus['id_estatus'] = $rowEstatusPropiedad['id_estatus'];
               $estatus['nombre_estatus'] = $rowEstatusPropiedad['nombre_estatus'];

               array_push($estatusPropiedad, $estatus);
            }
            return $estatusPropiedad;
        }catch(PDOException $e){
            return[];
        }
    } //End function

    public function getRegionesModel(){
        $arrayRegiones = [];
        try{
            $queryRegiones = $this->db->connect()->prepare("SELECT * FROM ubicacion_region");
            $queryRegiones->execute();

            while($rowRegiones = $queryRegiones->fetch()){
                $region = array();
                $region['id'] = $rowRegiones['id_region'];
                $region['nombre'] = $rowRegiones['nombre_region'];

                array_push($arrayRegiones, $region);
            }
            return $arrayRegiones;
        }catch(PDOException $e){
            return[];
        }
    }

    public function registrarPropiedadModel($data){
        $insertPropiedad = $this->db->connect();
        $queryInsertarPropiedad = $insertPropiedad->prepare("INSERT INTO tec_propiedad_intelectual
        (
            fk_tecnologia,
            titularPropiedad,
            inventores,
            fk_tipoPropiedad,
            tituloPropiedad,
            resumenPropiedad,
            estatus,
            -- regionPropiedad,
            numeroPatente,
            link
        ) 
        VALUES
        (
            '".$_SESSION['techID']."',
            '".$data['titularPropiedad']."',
            '".$data['inventoresPropiedad']."',
            '".$data['tipoPropiedad']."',
            '".$data['tituloPropiedad']."',
            '".$data['resumenPropiedad']."',
            '".$data['estatusPropiedad']."',
            '".$data['numeroPatentePropiedad']."',
            '".$data['linkPropiedad']."'
        )");
        try{
            $envio = $queryInsertarPropiedad->execute();
            if($envio){
				return $insertPropiedad->lastInsertId(); //el ultimo Id de la tabla insertada
			}else{
				//print_r($queryInsertarPropiedad->errorInfo());
                return "error";
            }

        }catch(PDOException $e){
            //echo $e;
            //echo 'data:('.$data['data'].')';
            return null;

        } 
    }

    // Función para registrar la región de la propiedad Intelectual
    public function registrarRegionPropiedad($data){
        $insertRegionPropiedad = $this->db->connect();
        $queryInsertarRegionPropiedad = $insertRegionPropiedad->prepare(
            "INSERT INTO tec_propiedad_intelectual_as_region
            (
                fk_tecnologia, 
                fk_regionPropiedad
            )
            VALUES
            (
                '".$_SESSION['techID']."', 
                '".$data['fk_regionPropiedad']."'
            )");
        try{
            $envio_regionPropeidad = $queryInsertarRegionPropiedad->execute();
            if($envio_regionPropeidad){
                return $insertRegionPropiedad->lastInsertId();
            }else{
                return "error";
            }
        }catch(PDOException $e){
            return null;
        }
    }
        
        
    
}//End model
