<?php

class directorio_ies extends Controller{
    function __construct(){
        parent::__construct();
    }

    function render(){
        if (isset($_SESSION['userId'])) {
            $this->view->render('directorio_ies/index');
        } else {
            header('Location: '.constant('URL'));
        }
    }
    
    public function paginador_instituciones($pagina, $registros, $id, $url){

    }

}

?>