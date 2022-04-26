<?php

class UserManagement extends Controller{

   function __construct(){
       parent::__construct();
   }

   function render(){
       if (isset($_SESSION['userId']) and $_SESSION['userType'] == 3) {
           $this->view->render('userManagement/index');
       } else {
           header('Location: '.constant('URL'));
       }
   }

   function searchUser(){

       $result = array();
       $result ['error'] = false;
       $result ['mensaje'] = "usuario encontrado";
       $result ['sessionActive'] = isset($_SESSION['userId']);

       if ($result ['sessionActive']) {
           $search_term = $_POST['search_term'];
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