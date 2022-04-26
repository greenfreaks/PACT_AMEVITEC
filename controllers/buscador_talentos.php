<?php

class buscador_talentos extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('buscador_talentos/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function templateFunction(){

        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            header('Location: '.constant('URL'));
        }

        echo json_encode($result);
    }

}

?>