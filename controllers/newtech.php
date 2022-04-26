<?php

class Newtech extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('newtech/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function getCatalogosPredicados(){

        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            $result['tipo_tecnologia'] = $this->model->getTipoTecnologia();
            $result['verbos'] = $this->model->getVerbos();
            $result['tiposUsuarios'] = $this->model->getTipoUsuario();
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            header('Location: '.constant('URL'));
        }

        echo json_encode($result);
    }

    function getObjetivosONU(){

        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            $result ['objetivos'] = $this->model->getObjetivosONU();
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            header('Location: '.constant('URL'));
        }

        echo json_encode($result);
    }

    function setTech(){

        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {

            $data['techname'] = isset($_POST['techname']) ? $_POST['techname']  : NULL;
            $data['alianza'] = isset($_POST['alianza']) ? $_POST['alianza']  : NULL;
            $data['problematica'] = isset($_POST['problematica']) && !empty($_POST['problematica']) ? $_POST['problematica']  : NULL;
            $data['sectores'] = isset($_POST['sectores']) && !empty($_POST['sectores']) ? $_POST['sectores']  : NULL;
            $data['predicados'] = isset($_POST['predicados']) && !empty($_POST['predicados']) ? $_POST['predicados']  : NULL;
            $data['objetivos'] = isset($_POST['objetivos']) && !empty($_POST['objetivos']) ? $_POST['objetivos']  : NULL;

            if(
                is_null($data['techname']) ||
                is_null($data['alianza']) ||
                is_null($data['problematica']) ||
                is_null($data['sectores']) ||
                is_null($data['predicados']) ||
                is_null($data['objetivos']) 
            ){
                $result ['error'] = true;
                $result ['mensaje'] = "Datos obligatorios faltantes, verifique el formulario.";
            }else{    
                //$result['data']=$data;       
                //obtener id de perfil academico
                $idusuario = $_SESSION['userId'];
                //insertar tecnologia nueva y obtener su id
                $result['idTecnologia'] = $this->model->insertProject([
                    'idusuario' => $idusuario, 
                    'techname' => $data['techname'] ,
                    'alianzaID' => $data['alianza']
                    ]);

                if(is_null($result['idTecnologia']) ){
                    $result ['error'] = true;
                    $result ['mensaje'] = "Error al registrar tecnología, verifique sus datos";
                }else{
                    //insertar problematicas
                    foreach ($data['problematica'] as $value) {
                        $this->model->insertProblematica([
                            'idTecnologia' => $result['idTecnologia'],
                            'problematica' => $value
                        ]);
                    }
                    //insertar sectores Industriales
                    foreach ($data['sectores'] as $value) {
                        $this->model->insertSector([
                            'idTecnologia' => $result['idTecnologia'],
                            'idrama' => $value['idrama']
                        ]);
                    }
                    //insertar Predicados
                    foreach ($data['predicados'] as $value) {
                        $this->model->insertPredicado([
                            'tecnologiaID' => $result['idTecnologia'],
                            'idtecnologia' => $value['idtecnologia'],
                            'idusuario' => $value['idusuario'],
                            'idverbo' => $value['idverbo'],
                            'complemento' => $value['complemento'],
                        ]);
                    }
                    //insertar Objetivos ONU
                    foreach ($data['objetivos'] as $value) {
                        $this->model->insertObjetivo([
                            'tecnologiaID' => $result['idTecnologia'],
                            'objetivo' => $value,
                        ]);
                    }
                }                
            }
            
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            header('Location: '.constant('URL'));
        }

        echo json_encode($result);
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