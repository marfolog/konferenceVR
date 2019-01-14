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
        Session::init();
        
        if($log == null || $password1 == null  || $password2 == null || $log == '' || $password1 == '' || $password2 == ''){
            Session::addSession(SS_REGISTER_STATUS, 'not_filled_form');
            Session::addSession(SS_TRIED_REGISTER, 'true'); 
 
        } else if($password1 != $password2) {
            
            Session::addSession(SS_REGISTER_STATUS, 'password_not_same');
            Session::addSession(SS_TRIED_REGISTER, 'true'); 
        } else if($this->isUserLoginInDB($log) == false){
            //registrovat
            if(strlen($log) >= 6 && strlen($log) <= 16 && strlen($password1) >=6) {
                 $password1 = md5($password1);
                 $password2 = md5($password2);
                 $user = $this->registerUserToDB($log, $password1);

                 $this->loginUserToSession($user);
                 Session::addSession(SS_REGISTER_STATUS, 'user_registered');
                 Session::addSession(SS_TRIED_REGISTER, 'false'); 
            } else {
                Session::addSession(SS_REGISTER_STATUS, 'short_login');
                Session::addSession(SS_TRIED_REGISTER, 'true');
            }
        } else {
            Session::addSession(SS_REGISTER_STATUS, 'same_login');
            Session::addSession(SS_TRIED_REGISTER, 'true'); 
        }
        
    }
    
    
    
//--------------------------------------------------------------------------------------------------------------
//-----------------------------------------------DATABASE-------------------------------------------------------
//--------------------------------------------------------------------------------------------------------------
    
    
    
    
      /*vrátí uživatele pokud je v DB*/
    public function isUserLoginInDB($log){
        $query = "SELECT 'login' FROM ".DB_USER_TABLE." WHERE `login` =:log";

         $out = $this->db->prepare($query);
         $log = htmlspecialchars($log);
         $out->execute(array(":log" => $log));
       
        $user = $out->fetchAll();
         if(!isset($user) || count($user) == 0){
             return false;
         } else {
             return true;
        }
    }
    
    
    
      /*Vloží uživatele do databáze*/
        public function registerUserToDB($log, $password){
            // zjistim, zda ho uz nemam v DB
            $user = $this->getUserFromDB_Log($log);
            if(!isset($user) || count($user) == 0){
                /// ziskam vysledek dotazu klasicky
                $query = "INSERT INTO ".DB_USER_TABLE." (login, password) VALUES (:log, :pas);";
                $out = $this->db->prepare($query);

                $unchanged = $log;
                $log = htmlspecialchars($log);
                $password = htmlspecialchars($password);
                $out->execute(array(":log" => $log,":pas" => $password));
                
                return $this->getUserFromDB_Log($unchanged)[0];
            } else {
                return null;
            }
        }
    

  
         
       
         
         
    }
?>