<?php

class eliminar_laboratorio_individual extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('eliminar_laboratorio_individual/index');
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