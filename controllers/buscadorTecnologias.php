<?php

class buscadorTecnologias extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('buscadorTecnologias/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function getTech(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            $result ['tecnologias'] = $this->model->getAllTech();
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesión no iniciada.";
            //header('Location: '.constant('URL'));
        }
        echo json_encode($result);
    }
    

}

?>