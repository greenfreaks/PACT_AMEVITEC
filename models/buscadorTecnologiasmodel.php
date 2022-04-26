<?php
class buscadorTecnologiasModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function getAllTech(){
        $allTechnologies = [];
        try{
            $queryTechnologies = $this->db->connect()->prepare('SELECT * FROM tecnologia tec
            INNER JOIN tipo_alianza t_ali ON tec.tipo_alianza_idtipo_alianza = t_ali.idtipo_alianza');
            $queryTechnologies->execute();
            while($rowTechnologies = $queryTechnologies->fetch()){
                $technology=array();
                $technology['idtecnologia'] = $rowTechnologies['idtecnologia'];
                $technology['nombre'] = $rowTechnologies['nombre'];
                array_push($allTechnologies, $technology);
            }
            return $allTechnologies;
        }catch(PDOException $e){
            //echo e;
            return [];
        }
    }

    function getManeraSolucionar($id_tecnologia){
        $allManeras = [];
        try{
            $queryManeras = $this->db->connect()->prepare("SELECT * FROM manera_solucionar ms
            INNER JOIN tipo_tecnologia tipotec ON ms.tipo_tecnologia_idtipo_tecnologia = tipotec.idtipo_tecnologia
            INNER JOIN usuario_tecnologia usuariotec ON ms.usuario_tecnologia_idusuario_tecnologia = usuariotec.idusuario_tecnologia
            INNER JOIN verbo_solucion verbo ON ms.verbo_solucion_idverbo_solucion = verbo.idverbo_solucion
            WHERE tecnologia_idtecnologia = :tecnologiaID");
            $queryManeras->execute(['tecnologiaID' => $id_tecnologia['idtecnologia']]);
            while($rowManeras = $queryManeras->fetch()){
                $manera = array();
                $manera['tipo_tecnologia'] = $rowManeras['tipo_tecnologia'];
                array_push($allManeras, $manera);
            }
            return $allManeras;
        }catch(PDOException $e){
            return [];
        }
    }
}
?>