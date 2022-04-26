<?php
class tabla extends Controller{

    function __construct(){
        parent::__construct();
    } //End construct

    function render(){
        $this->view->render("tabla/index");
    } //End function render

    public function showInstituciones(){
        $result = array();
        $result ['error'] = false;
        $result ['mensaje'] = "";
        $result ['sessionActive'] = isset($_SESSION['userId']);
        if ($result ['sessionActive']) {
            $result = "hOLA";
        }

    }
}
?>