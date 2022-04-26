<?php

class registro_tecnologias extends Controller{
    function __construct(){
        parent::__construct();
        //$this->view->mensaje = "Hay un error al cargar el recurso";
        
        //echo "<p>Controlador Index</p>";
        //$this->loadModel('dashboard');
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            unset($_SESSION['techID']);
            $this->view->render('registro_tecnologias/index');
            //$this->loadModel('dashboard');
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