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
    }

}

?>