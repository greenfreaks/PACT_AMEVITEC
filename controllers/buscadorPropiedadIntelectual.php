<?php

class buscadorPropiedadIntelectual extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('buscadorPropiedadIntelectual/index');
        } else {
            header('Location: '.constant('URL'));
        }
    } // END RENDER FUNCTION

    // Función controlador para obtener las propiedades intelectuales

    function getAllPropiedadIntelectualController(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);


        if($result ['sessionActive']){
            $result ['propiedadesIntelectuales'] = $this->model->getAllPropiedadIntelectualModel();
            // $result ['nivelTrl'] = $this->model->getAllNvlTrlModel();
        }else{
            $result ['error'] = true;
            $result ['mensaje'] = "Sesión no iniciada";
        }
        echo json_encode($result);
    } // END FUNCTION
    

} // END CLASS

?>