<?php

class UserSession  {

    public function __construct(){
        //session_start();
    }

    public function setCurrentUserData($ID,$username,$usertype,$profileID){
        $_SESSION['userId'] = $ID;
        $_SESSION['username'] = $username;
        $_SESSION['userType'] = $usertype;
        $_SESSION['profileID'] = $profileID;

    }

    public function  isLogged(){
        return isset($_SESSION['userId']);
    }

    public function getCurrentUserID(){
        return $_SESSION['userId'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }
}

?>