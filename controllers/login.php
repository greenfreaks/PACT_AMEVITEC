<?php

class Login extends Controller{
    function __construct(){
        parent::__construct();
        $this->view->mensaje = "";
        //$this->view->mensaje = "Hay un error al cargar el recurso";
        //echo "<p>Controlador Index</p>";
    }

    function render(){
        $this->view->render('login/index');
    }

    function login(){

        $result = array();
        $result ['error'] = false;
        $result ['message'] = "logged in";

        $user = $_POST['user'];
        $pass = $_POST['pass']; 

        unset($_SESSION['userId']);

        if ($this->model->userExists($user,$pass)) {
            $this->model->setId($user,$pass);
        } else {
            $result ['error'] = true;
            $result ['message'] = "Error en usuario o contraseña";
        }

        echo json_encode($result);
    }

    function logout(){
        $this->model->logout();
        header('Location: '.constant('URL'));
    }

}

?>