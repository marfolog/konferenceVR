<?php
    /*Třída, kontroler pro stránku s přihlašováním do systému*/
    class Login extends Controller {
        
        function __construct(){
            parent::__construct();
        }
        
        
        /*Necháváme zobrazit požadovanou stránku - neřešíme uživatele*/
         function showView(){
            Session::addSession(SS_TRIED_REGISTER, 'false'); 
            $this->view->render("login");
         }
        
        
        /*Funkce která se volá po stisknutí na tlačítko příhlásit na stránce s přihlášením*/
        function loginUser(){
            $this->model->loginUser();
        }
        
        
        /*Funkce pro odhlášení uživatele*/
        function logoutUser(){
            $this->model->logoutUser();
        }
        
        
        
        
        
        
        
        /*
         * Funkce pro výpis chybových hlášek na stránce
         *
         */
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