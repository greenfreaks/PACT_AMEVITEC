<?php
class buscadorPropiedadIntelectualModel extends Model{
    public function __construct()
    {
        parent::__construct();
    }
    
    // Function for getting la Propiedad Intelectual registrada.
    public function getAllPropiedadIntelectualModel(){
        $array_propiedad = [];
        try{
            $query_propiedad = $this->db->connect()->prepare
            ("SELECT * FROM tec_propiedad_intelectual pi
                INNER JOIN tecnologia tec ON pi.fk_tecnologia = tec.idtecnologia
                INNER JOIN tec_tipo_propiedad_intelectual tipoProp ON pi.fk_tipoPropiedad = tipoProp.id_tipoPropiedadIntelectual
                INNER JOIN tec_propiedad_intelectual_estatus estatusProp ON pi.estatus = estatusProp.id_estatus");
            $query_propiedad->execute();
            
            while($row_propiedad = $query_propiedad->fetch()){
                $propiedad = array();
                $propiedad['id_registro'] = $row_propiedad['id_registroPropiedad'];
                $propiedad['fk_tecnologia'] = $row_propiedad['fk_tecnologia'];
                $propiedad['nombreTec'] = $row_propiedad['nombre'];
                $propiedad['titular'] = $row_propiedad['titularPropiedad'];
                $propiedad['inventores'] = $row_propiedad['inventores'];
                $propiedad['tipo'] = $row_propiedad['nombre_tipoPropiedadIntelectual'];
                $propiedad['titulo'] = $row_propiedad['tituloPropiedad'];
                $propiedad['resumen'] = $row_propiedad['resumenPropiedad'];
                $propiedad['estatus'] = $row_propiedad['nombre_estatus'];
                $propiedad['numeroPatente'] = $row_propiedad['numeroPatente'];
                $propiedad['link'] = $row_propiedad['link'];

                $niveltrl = [];
                // $propiedad['query'] = "SELECT DISTINCT (nivel) FROM evaluaciontrl WHERE tecnologia_idtecnologia = ".$row_propiedad['fk_tecnologia'];  
                $query_nvlTrl = $this->db->connect()->prepare("SELECT DISTINCT (nivel) AS nivel, startTime 
                FROM evaluaciontrl 
                WHERE tecnologia_idtecnologia = {$row_propiedad['fk_tecnologia']} 
                ORDER BY `evaluaciontrl`.`startTime` 
                ASC LIMIT 1 ");
                $query_nvlTrl->execute();
                // $y = 0;
                while($rowPropId = $query_nvlTrl->fetch()){
                    // if($y == 0){
                    //     $niveltrl = $rowPropId['nivel'];
                    // }else{
                    //     // $niveltrl .= ', '.$rowPropId['nivel'];

                    // }
                    // $y++;
                    // array_push($niveltrl, $rowPropId['nivel']);
                    array_push($niveltrl, $rowPropId);
                }
                $propiedad['nivelTrl'] = $niveltrl;

                $regionPropiedad = [];
                $query_regionPropiedad = $this->db->connect()->prepare("SELECT DISTINCT (nombre_region) AS fk_regionPropiedad 
                FROM tec_propiedad_intelectual_as_region tec_reg
                INNER JOIN ubicacion_region ubi ON tec_reg.fk_regionPropiedad = ubi.id_region
                WHERE fk_tecnologia = {$row_propiedad['fk_tecnologia']}
                ");
                $query_regionPropiedad->execute();
                while($rowPropId = $query_regionPropiedad->fetch()){
                    array_push($regionPropiedad, $rowPropId);
                }
                $propiedad['regionPropiedad'] = $regionPropiedad;

                array_push($array_propiedad, $propiedad);
            }
            return $array_propiedad;
        }catch(PDOException $e){
            return [];
        }
    } // END FUNCTION.

    // FUNCTION FOR GETTING TRL LEVEL
    public function getAllNvlTrlModel($id_tec){
        $array_nivelTrl = [];
        try{
            //$query_nvlTrl = $this->db->connect()->prepare("SELECT * FROM evaluaciontrl");
            //$query_nvlTrl->execute();
            $query_nvlTrl = $this->db->connect()->prepare("SELECT * FROM evaluaciontrl WHERE tecnologia_idtecnologia = ".$id_tec);
            $query_nvlTrl->execute();

            while($row_nvlTrl = $query_nvlTrl->fetch()){
                $nvlTrl = array();
                $nvlTrl['id_tec'] = $row_nvlTrl['tecnologia_idtecnologia'];
                $nvlTrl['nivel_tec'] = $row_nvlTrl['nivel'];
                
                array_push($array_nivelTrl, $nvlTrl);
            }
            return $array_nivelTrl;
        }catch(PDOException $e){
            return[];
        }
    } // END FUNCTION
}//End model
