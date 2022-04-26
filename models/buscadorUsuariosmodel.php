<?php
class usuariosPACT{
    private $conector;
    private $BaseDatos;
    private $Servidor;
    private $Usuario;
    private $Clave;

    // Consulta para obtener los registros registro de perfil academico
    function getUsuarios(){  
        $sql = "SELECT * FROM usuario_general ug
        INNER JOIN tipo_usuario tu ON ug.tipo_usuario_idtipo_usuario = tu.idtipo_usuario";
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