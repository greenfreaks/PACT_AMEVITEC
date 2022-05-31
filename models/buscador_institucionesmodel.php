<?php
class Instituciones{
    private $conector;
    private $BaseDatos;
    private $Servidor;
    private $Usuario;
    private $Clave;
    
    function getInstituciones(){
        $sql = "SELECT * FROM uci_instituciones ins
        INNER JOIN uci_tipo_institucion tipo ON ins.fk_tipo_institucion = tipo.id_tipo_institucion
        INNER JOIN estado est ON ins.estado = est.idestado
        WHERE authorized_for_capacidades = 1
        ORDER BY nombre_institucion";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }

    //--------------Áreas de oferta educativa-----------------

    function getAreasInvestigacion($id_institucion){
        $sql = "SELECT * FROM uci_areas_oferta_educativa_as_institucion oferta_e
        INNER JOIN  uci_areas_oferta_educativa oferta_concept ON oferta_e.fk_id_area_oferta = oferta_concept.id_area_oferta
        WHERE fk_id_institucion = '$id_institucion'";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }

    //--------------Áreas_de educación continua-----------------

    function getServiciosEducacion($id_institucion){
        $sql = "SELECT * FROM uci_areas_educacion_continua_as_institucion educacion_c
        INNER JOIN  uci_areas_educacion_continua educacion_concept ON educacion_c.fk_id_areas_educacion_continua = educacion_concept.id_area_educacion_continua
        WHERE fk_id_institucion = '$id_institucion'";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }

    // function editInstitucion($id_institucion){
    //     $sql = "UPDATE uci_instituciones SET ";
    //     $datos = array();

    //     if($rs = $this->conector->query($sql)){
    //         while($fila = $rs->fetch_assoc()){
    //             $datos[] = $fila;
    //         }
    //     }
    //     return $datos;
    // }

    function __construct(){
        $this->BaseDatos = "tecnotr1_bd_tbr_plataforma";
        $this->Servidor = "localhost";
        $this->Usuario = "root";
        $this->Clave = "";
        // $this->Usuario = "tecnotr1_webmstr";
        // $this->Clave = "Oa?*&2#Bzuqt";
    }

    function conectar(){
        $this->conector = new mysqli($this->Servidor,$this->Usuario,$this->Clave, $this->BaseDatos);
        if($this->conector->connect_errno){
            return 0;
        }else{
            $this->conector->set_charset('utf8');
            return 1;
        }
    }
}
?>