<?php

class registroPropiedadIntelectual extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('registroPropiedadIntelectual/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function getSectores(){
        $result = array();
        $result['error'] = false;
        $result['mensaje'] = "";
        $result['sessionActive'] = isset($_SESSION['userId']);

        if($result['sessionActive']){
            $result['sectoresIndustriales'] = $this->model->getSectoresIndustrialesModel();
        }else{
            $result['error'] = true;
            $result['mensaje'] = "Sesión no iniciada";

        }
    }
    function registrarPropiedad(){
        if ($this->model->isTechOfUser($_SESSION['techID'])){
            $this->view->techID = $_SESSION['techID'];
            header('Location: '.constant('URL').'registroPropiedadIntelectual');
        } else {
            header('Location: '.constant('URL'));
        }
    }

}

?>