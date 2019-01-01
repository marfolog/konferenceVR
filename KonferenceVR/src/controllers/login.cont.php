<?php
    class Login extends Controller {
        
        function __construct(){
            parent::__construct();
        }
        
         function showView(){
            Session::addSession(SS_TRIED_REGISTER, 'false'); 
            $this->view->render("login");
         }
        
        
        function loginUser(){
            $this->model->loginUser();
        }
        
        
        function logoutUser(){
            $this->model->logoutUser();
        }
        
    }
?>