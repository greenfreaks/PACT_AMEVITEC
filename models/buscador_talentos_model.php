<?php
class Talentos{
    private $conector;
    private $BaseDatos;
    private $Servidor;
    private $Usuario;
    private $Clave;

    // Consulta para obtener los registros registro de perfil academico
    function getTalents(){  
        $sql = "SELECT idperfil_academico, titulo_obtenido, estado FROM perfil_academico pa
        INNER JOIN usuario_general ug ON pa.usuario_general_idusuario_general = ug.idusuario_general
        INNER JOIN municipio muni ON ug.municipio_idmunicipio = muni.idmunicipio
        INNER JOIN estado est ON  muni.estado_idestado = est.idestado";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }
    // ¿En qué actividad consideras que tienes tu mayor experiencia?
    function getExpertise($id_perfil){
        $sql = "SELECT * FROM perfil_academico_has_actividad_experiencia actxp 
        INNER JOIN actividad_experiencia meanactxp ON actxp.actividad_experiencia_idactividad_experiencia = meanactxp.idactividad_experiencia
        WHERE perfil_academico_idperfil_academico = $id_perfil";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }

    // ¿En qué actividad te gustaría desarrollar tus talentos?
    function getInteres($id_perfil){
        $sql = "SELECT * FROM perfil_academico_has_actividad_desarrollo desarrollo
        INNER JOIN actividad_desarrollo meanactiv ON desarrollo.actividad_desarrollo_idactividad_desarrollo = meanactiv.idactividad_desarrollo
        WHERE perfil_academico_idperfil_academico = $id_perfil";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }

    function getSectorExperiencia($id_perfil){
        $sql = "SELECT * FROM organizaciones_experiencia orgsxp
        INNER JOIN organizacion org ON orgsxp.organizacion_idorganizacion = org.idorganizacion
        WHERE perfil_academico_idperfil_academico = $id_perfil";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }

    function getHabilidadesDesarrolladas($id_perfil){
        $sql = "SELECT * FROM organizaciones_experiencia orgsxp
        INNER JOIN organizacion org ON orgsxp.organizacion_idorganizacion = org.idorganizacion
        WHERE perfil_academico_idperfil_academico = $id_perfil";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }

    function sendTalent($id_perfil){
        $sql = "SELECT idperfil_academico, titulo_obtenido, estado FROM perfil_academico pa
        INNER JOIN usuario_general ug ON pa.usuario_general_idusuario_general = ug.idusuario_general
        INNER JOIN municipio muni ON ug.municipio_idmunicipio = muni.idmunicipio
        INNER JOIN estado est ON  muni.estado_idestado = est.idestado";
        $datos = array();

        if($rs = $this->conector->query($sql)){
            while($fila = $rs->fetch_assoc()){
                $datos[] = $fila;
            }
        }
        return $datos;
    }

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