<?php
    /*třída pro stránk us registrací uživatele*/
    class Register extends Controller {
        
        function __construct(){
            parent::__construct();
            
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            echo $logged;
            if($logged == "user_logged"){
                header('location: index.php?page=0');
                exit;
            }
        }
        
        
        /*Necháváme zobrazit požadovanou stránku - neřešíme uživatele*/
         function showView(){
            $logged = Session::readSession(SS_LOGIN_STATUS);
            if($logged == "user_logged"){
                header('location: index.php?page=0');
                exit;
            } else {               
                $this->view->render("register");
            }

         } 
        
        
        
        /*Funcke, která se volá po stisknutí na tlačítko registrovat*/
         function registerUser(){
            $this->model->registerUser();
         }
          
        /*
         * Funkce, která vypisuje chybové hlášení na stránku v případě špatného/ neočekávaného vstupu
         *
         */
        public function verifyLog() {
             Session::init();
             if(Session::readSession(SS_TRIED_REGISTER) == 'true'){
                switch (Session::readSession(SS_REGISTER_STATUS)) {
                        case 'user_registered':
                            break;
                        case 'same_login':
                            echo "<div style='color:red'> Tento uživatel už existuje </div><br>";
                            break;
                        case 'password_not_same':
                            echo "<div style='color:red'> Hesla nejsou stejná </div><br>";
                            break;
                        case 'not_filled_form':
                            echo "<div style='color:red'> Nebyla vyplněna všechna pole </div><br>";
                            break;
                        case 'short_login':
                            echo "<div style='color:red'> Zadejte uživatel. jméno a heslo v rozmezí 6 až 32 znaků dlouhé</div><br>";
                            break;
                        default: echo "";

                    }
            } else {
                echo "";
            }
        }
        
    }
?>