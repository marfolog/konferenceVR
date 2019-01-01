<?php 
class Register_Model extends Model {
    

    public function __construct(){ 
        parent::__construct();
        Session::init();
    }
    
    
    
    
    public function registerUser(){
        $log = $_POST['login'];
        $password1 = $_POST['pass1'];
        $password2 = $_POST['pass2'];
        echo "<br>pas1: ".$password1."<br>";
        echo "log: ".$log."<br>";
        echo "pas2: ".$password2."<br>";
        Session::init();
        
        if($log == null || $password1 == null  || $password2 == null || $log == '' || $password1 == '' || $password2 == ''){
            Session::addSession(SS_REGISTER_STATUS, 'not_filled_form');
            Session::addSession(SS_TRIED_REGISTER, 'true'); 
 
        } else if($password1 != $password2) {
            
            Session::addSession(SS_REGISTER_STATUS, 'password_not_same');
            Session::addSession(SS_TRIED_REGISTER, 'true'); 
        } else if($this->isUserLoginInDB($log) == false){
            //registrovat
             $password1 = md5($password1);
             $password2 = md5($password2);
             $user = $this->registerUserToDB($log, $password1);
             
             $this->loginUserToSession($user);
             Session::addSession(SS_REGISTER_STATUS, 'user_registered');
             Session::addSession(SS_TRIED_REGISTER, 'false'); 
        } else {
             echo "tento uživatel už existuje";
            Session::addSession(SS_REGISTER_STATUS, 'same_login');
            Session::addSession(SS_TRIED_REGISTER, 'true'); 
        }
        
    }
    

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
                    default: echo "";

                }
        } else {
            echo "";
        }
    }
         
       
         
         
    }
?>