<?php

class buscador extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId']) and $_SESSION['userType'] == 3) {
            $this->view->render('buscador/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function getSearchResults(){
        $result = array();
        $result ['error'] = false;
        $result ['msj'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);
        $searchtext = !isset($_POST['input-busqueda'] ) ? "" : $_POST['input-busqueda'] ;
    
        if ($result ['sessionActive'] and $_SESSION['userType'] == 3) {
            //TODO Leo activar busqueda
            //$result['matchUsers']= $this->model->searchUser($searchtext);
            //$result['matchProjects']= $this->model->searchProjects($searchtext);

        } else {
            $result ['error'] = true;
            $result ['msj'] = "Sesion no iniciada.";
            //header('Location: '.constant('URL'));
        }
    
        echo json_encode($result);
    }

}

?>