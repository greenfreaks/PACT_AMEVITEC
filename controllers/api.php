<?php

class Api extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
    }

    function render(){
        $this->view->render('api/index');
    }

    function getMunicipios(){
        $result = array();
        $result ['error'] = false;
        $result ['message'] = "Municipios Cargados";

        $result ['estados'] = $this->model->getMunicipios();

        if (empty($result ['estados'])) {
            $result ['error'] = true;
            $result ['message'] = "Error al obtener municipios";
        }
        echo json_encode($result);
    }

    function getSCIAN(){
        
    }

    function getDisciplinas(){
        $result = array();
        $result ['error'] = false;
        $result ['message'] = "Campos del conocimiento cargados";

        $result ['campos'] = $this->model->getDisciplinas();

        if (empty($result ['campos'])) {
            $result ['error'] = true;
            $result ['message'] = "Error al obtener campos del conocimiento";
        }

        echo json_encode($result);
    }

    function getSectores(){
        $result = array();
        $result ['error'] = false;
        $result ['message'] = "Sectores Industriales Cargados";

        $result ['sectores'] = $this->model->getSectores();

        if (empty($result ['sectores'])) {
            $result ['error'] = true;
            $result ['message'] = "Error al obtener Sectores Industriales";
        }

        echo json_encode($result);
    }
}

?>