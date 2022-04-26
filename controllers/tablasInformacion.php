<?php
class tablasInformacion extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('tablasInformacion/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }


    function getAllInstituciones(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            $result ['instituciones'] = $this->model->getAllInstitucionesModel();
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesión no iniciada.";
            //header('Location: '.constant('URL'));
        }
        echo json_encode($result);
    }

    function getAreas($id_institucion){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);
        if ($result ['sessionActive']) {
            
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesión no iniciada.";
            //header('Location: '.constant('URL'));
        }
        echo json_encode($result);
    }
}
?>