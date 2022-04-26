<?php

class Trl extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('trl/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function evaluarProyecto(){
        if ($this->model->isTechOfUser($_SESSION['techID']) AND $this->model->canBeEvaluated()){
            $this->view->techID = $_SESSION['techID'];
            header('Location: '.constant('URL').'trl');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function getPreguntas(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            $result ['preguntas_TRL'] = $this->model->getPreguntas();
        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            header('Location: '.constant('URL'));
        }
        echo json_encode($result);
    }

    function setEval(){

        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);

        if ($result ['sessionActive']) {
            $data = $_POST;
            $idEval = $this->model->insertEval($data);
            if(is_null($idEval)){
                $result ['error'] = true;
                $result ['mensaje'] = "Error al evaluar tecnología.";
            }else{
                $this->model->insertAnswers($data['checkedItems'],$idEval);
                $LevelTRL = $this->model->getTrlLevelPlus($idEval);
                $this->model->updateEvalTrlLevel($LevelTRL['nivel'],$idEval);
                $Cat = $this->model->getCategories($idEval);
                $this->model->updateCategories($Cat,$idEval);
                $this->model->clearAnswers($idEval);
                $result ['idTecnologia'] = $_SESSION['techID'];
            }
            //$result ['data'] = $_POST;
            //answers String
            //checkedItems array
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