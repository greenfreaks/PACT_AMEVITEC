<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Technology extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('technology/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function isTechofUser($param = null){
        if ($this->model->isTechOfUser($param[0])) {
            echo 'si es '.$param[0];
        } else {
            echo 'no es '.$param[0];
        }
    }

    function verproyecto($param = null){
        unset($_SESSION['techID']);
        $techID = $param[0];
        if ($this->model->isTechOfUser($techID) ){
            $_SESSION['techID'] = $techID;
            header('Location: '.constant('URL').'technology');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function getAllTech(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            $result ['technologies'] = $this->model->getAllTech();
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesión no iniciada.";
            //header('Location: '.constant('URL'));
        }
        echo json_encode($result);
    }

    function getTechData(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "Tecnologia Cargada";
        $result ['sessionActive'] = isset($_SESSION['userId']);
        if ($result ['sessionActive']) {
            $result ['techdata'] = $this->model->getTech();
            $result ['sectoresIndustriales'] = $this->model->getTechScian();
            $result ['predicados'] = $this->model->getPredicados();
            $result ['objetivos'] = $this->model->getObjetivosONU();
            $result ['beneficiados'] = $this->model->getBeneficiados();
            $result ['TRL'] = $this->model->getTRLEval();
            $result ['canBeEvaluated'] = $this->model->canBeEvaluated();
            $result ['technoid'] = $this->model->getAllTech();
     
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

    function genPDF($param = null){
        $evalID = $param[0];
        //$tipoUsuario = $param[1];
        //recibir el tipo de usuario mediante el enlace
        //$tipoUsuario = 1;

        if ($this->model->isTechOfUser($_SESSION['techID']) and ($this->model->estaDesbloquedoPDF($evalID))){
            $this->view->estaDesbloqueado = $this->model->estaDesbloquedoPDF($evalID);
            $this->model->insertAnswers($evalID);
            $this->view->firma = $this->model->obtenerFirma($evalID);
            $this->view->nombre = $this->model->nombreTecnologia($evalID);
            $this->view->nivel = $this->model->getTrlLevelPlus($evalID);
            $this->view->descripciones = $this->model->obtenerDescripcionNiveles();
            $this->view->avancesNivel = $this->model->obtenerAvancesNivel($evalID);
            $this->view->avancesCategoria = $this->model->obtenerAvancesCategoria($evalID);
            $this->view->recomEvid = $this->model->obtenerRecomendaciones($evalID);
            $this->view->serBasicos = $this->model->obtenerServiciosBasicos($_SESSION['userType']);
            $this->view->servicios = $this->model->obtenerPruductos($evalID,2,$_SESSION['userType']);
            $this->view->cursos = $this->model->obtenerPruductos($evalID,1,$_SESSION['userType']);
            $this->view->tpl = $this->model->obtenerSaltosGraficaTpl($evalID);
            $this->model->clearAnswers($evalID); 
            $this->view->render('technology/pdf'); 
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function unlockReport(){

        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "Licencia Valida";
        $result ['sessionActive'] = isset($_SESSION['userId']);
        $result ['isTechOfUser'] = $this->model->isTechOfUser($_SESSION['techID']);

        if ($result ['sessionActive'] AND $result ['isTechOfUser']) {
            $licencia = $_POST['licencia'];
            $idEval = $_POST['idEval'];
            $licenciaValida = $this->model->isLicenceValid($licencia);
            if($licenciaValida){
                $result['registrada'] = $this->model->setLicence($idEval,$licenciaValida);
            }else{
                $result ['error'] = true;
                $result ['mensaje'] = "La licnecia ingresada ya ha sido usada o no es valida.";
            }
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
        }

        echo json_encode($result);
    }
}

?>