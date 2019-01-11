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
        
        
        
        
        
        
        
        
    public function verifyLog(){
        if(Session::readSession(SS_TRIED_LOGGIN) == 'true'){
            switch (Session::readSession(SS_LOGIN_STATUS)) {
                    case 'user_logged':
                        break;
                    case 'uncorrect_user':
                        echo "Bylo zadáno špatné uživatelské jméno nebo heslo<br>";
                        break;
                    case 'not_filled_form':
                        echo "Nebylo vyplněno uživatelské jméno nebo heslo<br>";
                        break;
                    case 'block':
                        echo "Ste zablokován administrátorem<br>";
                        break;
                    default: echo "";

                }
        } else {
            echo "";
        }
    }
        
    }
?>