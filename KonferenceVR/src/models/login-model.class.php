<?php 
class Login_Model extends Model {
    

    public function __construct(){ 
        parent::__construct();
        Session::init();
    }
    
    
    public function loginUser(){      
        $log = $_POST['login'];
        $password = md5($_POST['password']);
        
        
       if($log == "" || $password == ""){
            Session::addSession(SS_LOGIN_STATUS, 'not_filled_form');
            Session::addSession(SS_TRIED_LOGGIN, 'true');
           
        } else {
            $user = $this->getUserFromDB_Log($log);
           
            if($user != null && count($user) > 0){
                if($user[0]['block'] == 'false'){
                    $this->loginUserToSession($user[0]);
                } else {
                    Session::addSession(SS_TRIED_LOGGIN, 'true');
                    Session::addSession(SS_LOGIN_STATUS, 'block');
                }

            } else {
                Session::addSession(SS_LOGIN_STATUS, 'uncorrect_user');
                Session::addSession(SS_TRIED_LOGGIN, 'true');
            }
       }
    }
    
 
    
   public function logoutUser(){
           Session::addSession(SS_LOGIN_STATUS, 'logout');
   }
    
    
//--------------------------------------------------------------------------------------------------------------
//-----------------------------------------------DATABASE-------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------- 
//-funkce v materske tride
    

}
?>