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
    }//End Function

    //Controlador para verificar que sea la tecnología del usuario
       function isTechofUser(){
        if ($this->model->isTechOfUser($_SESSION['techID'])){
            $this->view->techID = $_SESSION['techID'];
            header('Location: '.constant('URL').'registroPropiedadIntelectual');
        } else {
            header('Location: '.constant('URL'));
        }
    }//End Function

    //Controlador para obtener los sectores
    function getSectores(){
        $result = array();
        $result['error'] = false;
        $result['mensaje'] = "";
        $result['sessionActive'] = isset($_SESSION['userId']);

        if($result['sessionActive']){
            $result['sectoresIndustriales'] = $this->model->getAllSectoresModel();
        }else{
            $result['error'] = true;
            $result['mensaje'] = "Sesión no iniciada";
        }
        echo json_encode($result);
    }//End Function

    //Controlador para obtener el tipo de Propiedad Intelectual
    function getTipoPropiedadController(){
        $result = array();
        $result['error'] = false;
        $result['mensaje'] = "";
        $result['sessionActive'] = isset($_SESSION['userId']);

        if($result['sessionActive']){
            $result['tipoPropiedad'] = $this->model->getAllTipoPropiedadModel();
        }else{
            $result['error'] = true;
            $result['mensaje'] = "Sesión no iniciada";
        }
        echo json_encode($result);
    }// End Function

    //Controlador para obtener el tipo de Estatus de la PI
    function getEstatusPropiedadController(){
        $result = array();
        $result['error'] = false;
        $result['mensaje'] = "";
        $result['sessionActive'] = isset($_SESSION['userId']);

        if($result['sessionActive']){
            $result['tipoEstatusPropiedad'] = $this->model->getEstatusPropiedadModel();
        }else{
            $result['error'] = true;
            $result['mensaje'] = "Sesión no iniciada";
        }
        echo json_encode($result);
    }// End Function

    //Controlador para obtener la región de la PI
    function getRegionesPropiedadController(){
        $result = array();
        $result['error'] = false;
        $result['mensaje'] = "";
        $result['sessionActive'] = isset($_SESSION['userId']);

        if($result['sessionActive']){
            $result['regionPropiedad'] = $this->model->getRegionesModel();
        }else{
            $result['error'] = true;
            $result['mensaje'] = "Sesión no Iniciada";
        }
        echo json_encode($result);
    } // END FUNCITON

    //Controlador para registrar la Propiedad Intelectual 
    function registrarPropiedadController(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        // Obtener datos del formulario
        if ($result ['sessionActive']) {
            $data['titularPropiedad'] = isset($_POST['titularPropiedad']) ? $_POST['titularPropiedad'] : NULL;
            $data['inventoresPropiedad'] = isset($_POST['inventoresPropiedad']) ? $_POST['inventoresPropiedad'] : NULL;
            $data['tipoPropiedad'] = isset($_POST['tipoPropiedad']) ? $_POST['tipoPropiedad'] : NULL;
            $data['tituloPropiedad'] = isset($_POST['tituloPropiedad']) ? $_POST['tituloPropiedad'] : NULL;
            $data['resumenPropiedad'] = isset($_POST['resumenPropiedad']) ? $_POST['resumenPropiedad'] : NULL;
            $data['estatusPropiedad'] = isset($_POST['estatusPropiedad']) ? $_POST['estatusPropiedad'] : NULL;
            $data['fk_regionPropiedad'] = isset($_POST['fk_regionPropiedad']) ? $_POST['fk_regionPropiedad'] : NULL;
            $data['numeroPatentePropiedad'] = isset($_POST['numeroPatentePropiedad']) ? $_POST['numeroPatentePropiedad'] : NULL;
            $data['linkPropiedad'] = isset($_POST['linkPropiedad']) ? $_POST['linkPropiedad'] : NULL;

            if(
                is_NULL($data['titularPropiedad']) ||
                is_NULL($data['inventoresPropiedad']) ||
                is_NULL($data['tipoPropiedad']) ||
                is_NULL($data['tituloPropiedad']) ||
                is_NULL($data['resumenPropiedad']) ||
                is_NULL($data['estatusPropiedad']) ||
                is_NULL($data['fk_regionPropiedad']) ||
                is_NULL($data['numeroPatentePropiedad']) ||
                is_NULL($data['linkPropiedad'])
            ){
                $result ['error'] = true;
                $result ['message'] = "Dato obligatorio no proporcionado";
            }else{
                $idTecnologia = $_SESSION['techID'];
                $result = $this->model->registrarPropiedadModel([
                    'fk_tecnologia' => $idTecnologia,
                    'titularPropiedad' => $data['titularPropiedad'],
                    'inventoresPropiedad' => $data['inventoresPropiedad'],
                    'tipoPropiedad' => $data['tipoPropiedad'],
                    'tituloPropiedad' => $data['tituloPropiedad'],
                    'resumenPropiedad' => $data['resumenPropiedad'],
                    'estatusPropiedad' => $data['estatusPropiedad'],
                    // 'regionPropiedad' => $data['regionPropiedad'],
                    'numeroPatentePropiedad' => $data['numeroPatentePropiedad'],
                    'linkPropiedad' => $data['linkPropiedad']

                ]);
                foreach($data['fk_regionPropiedad'] as $valueRegion){
                    $this->model->registrarRegionPropiedad([
                        'fk_tecnologia' => $idTecnologia,
                        'fk_regionPropiedad' => $valueRegion    
                    ]);
                }
            }
        }else{
            $result['error'] = true;
            $result['mensaje'] = "Sesion no iniciada";
            header('Location: '.constant('URL'));
        }
        echo json_encode($result);
    }//End Function

}

?>