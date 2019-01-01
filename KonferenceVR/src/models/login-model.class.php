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
            $user = $this->getUserFromDB_LogPas($log, $password);
           
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
    
   public function logoutUser(){
           Session::destroy();
           Session::addSession(SS_LOGIN_STATUS, 'logout');
   }

    

}
?>