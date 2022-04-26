<?php
class tablasInformacionModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getAllInstitucionesModel(){
        $selected_allInstituciones = [];
        try{
            $query_instituciones = $this->db->connect()->prepare('SELECT * FROM `uci_instituciones`');
            $query_instituciones->execute();
            while($row_instituciones = $query_instituciones->fetch()){
                $institucion=array();
                $institucion['id_institucion'] = $row_instituciones['id_institucion'];
                $institucion['nombre_institucion'] = $row_instituciones['nombre_institucion'];

                array_push($selected_allInstituciones, $institucion);
            }
            return $selected_allInstituciones;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    public function getAllAreas($id_institucion){
        $selected_allAreas = [];
        try{
            $query_areas = $this->db->connect()->prepare("SELECT * FROM `uci_areas_oferta_educativa_as_institucion` WHERE fk_id_institucion = $id_institucion ");
            $query_areas->execute();
            while($row_areas = $query_areas->fetch()){
                $areas=array();
                $areas['fk_id_institucion'] = $row_areas['fk_id_institucion'];
                array_push($selected_allAreas, $areas);
            }
            return $selected_allAreas;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }



}
?>