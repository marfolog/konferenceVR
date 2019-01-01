<?php
    class Register extends Controller {
        
        function __construct(){
            parent::__construct();
            
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            echo $logged;
            if($logged == "user_logged"){
                header('location: index.php?page=index');
                exit;
            }
        }
        
         function showView(){
            $logged = Session::readSession(SS_LOGIN_STATUS);
            if($logged == "user_logged"){
                header('location: index.php?page=index');
                exit;
            } else {               
                $this->view->render("register");
            }

         } 
        
         function registerUser(){
            $this->model->registerUser();
         }
        
    }
?>