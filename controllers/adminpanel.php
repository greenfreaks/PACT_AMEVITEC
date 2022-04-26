<?php
class Adminpanel extends Controller{

    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId']) and $_SESSION['userType'] == 3) {
            $this->view->render('adminpanel/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }

    function getChartsData(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);
    
        if ($result ['sessionActive']) {

            $result['charts'] = array();

            array_push(
                $result['charts'],
                array(
                    "title"=>"Usuarios Registrados",
                    "id"=>"usuarios", 
                    "data" => $this->model->getChartUsuarios(),
                    "type" => "pie"
                )
            );

            //TODO Leo
            // Niveles TRL 
            array_push(
                $result['charts'],
                array(
                    "title"=>"Nivel TRL",
                    "id"=>"nivel_trl", 
                    "data" => $this->model->getChartTRL([]),
                    "type" => "bar"
                )
            );

            //TODO top 10 de Áreas academicas con más usuarios
            array_push(
                $result['charts'],
                array(
                    "title"=>"Áreas académicas",
                    "id"=>"areas_academicas", 
                    "data" => $this->model->getChartAreaAcademica([]), 
                    "type" => "bar"
                )
            );

            //TODO top 10 de estados con mas usuarios
            // array_push(
            //     $result['charts'],
            //     array(
            //         "title"=>"Densidad por Estado",
            //         "id"=>"estados", 
            //         "data" => $this->model->getChartUsuarios(), 
            //         "type" => "bar"
            //     )
            // );

            //TODO top 10 de Objetivo de la ONU con mas usuarios
            array_push(
                $result['charts'],
                array(
                    "title"=>"Objetivos de la ONU",
                    "id"=>"objetivos_onu", 
                    "data" => $this->model->getChartObjetivosONU([]), 
                    "type" => "bar"
                )
            );

            //TODO Usuarios con apoyos ( beca/cátedras/sni)
            // array_push(
            //     $result['charts'],
            //     array(
            //         "title"=>"Usuarios con Apoyos",
            //         "id"=>"apoyos", 
            //         "data" => $this->model->getChartUsuarios(), 
            //         "type" => "bar"
            //     )
            // );

            //TODO usuarios por Niveles academicos
            // array_push(
            //     $result['charts'],
            //     array(
            //         "title"=>"Niveles académicos",
            //         "id"=>"nivel_academico", 
            //         "data" => $this->model->getChartUsuarios(), 
            //         "type" => "bar"
            //     )
            // );

            //TODO top 10 de Tipos de soluciones ( procesos, producto, servicios, etc) con mas usuarios
            array_push(
                $result['charts'],
                array(
                    "title"=>"Tipos de soluciones",
                    "id"=>"soluciones", 
                    "data" => $this->model->getChartTipoSoluciones([]), 
                    "type" => "bar"
                )
            );

            //TODO top 10 de Tipo de colaboración con mas usuarios
            array_push(
                $result['charts'],
                array(
                    "title"=>"Tipo de colaboración",
                    "id"=>"colaboracion", 
                    "data" => $this->model->getChartTipoColaboraciones([]), 
                    "type" => "bar"
                )
            );

            //TODO top 10 de Sectores industriales con mas usuarios
            array_push(
                $result['charts'],
                array(
                    "title"=>"Sectores industriales",
                    "id"=>"sector_industrial", 
                    "data" => $this->model->getChartSectorIndustrial([]), 
                    "type" => "bar"
                )
            );

        } else {
            $result ['error'] = true;
            $result ['mensaje'] = "Sesion no iniciada.";
            //header('Location: '.constant('URL'));
        }
    
        echo json_encode($result);
    }

}
?>