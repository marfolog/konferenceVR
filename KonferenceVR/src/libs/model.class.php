<?php 
    class Model {
        
        function __construct(){
            $this->db = new Database();
        }
        
        
        
        public function executeQuery($dotaz){
            $res = $this->db->query($dotaz);
            if (!$res) {
                $error = $this->db->errorInfo();
                echo $error[2];
                return "error";
            } else {
                return $res;            
            }
         }
        
  
          public function getUserFromDB_LogPas($log, $pas){
                $query = "SELECT * FROM ".DB_USER_TABLE." WHERE `login` = '$log' AND `password` = '$pas'";
                $out = $this->executeQuery($query);
                //sql injectin??
                return $user_atributes_array = $out->fetchAll();
          }
        
          public function getUserFromDB_ID($idUser){
                $query = "SELECT * FROM ".DB_USER_TABLE." WHERE `id` = '$idUser'";
                $out = $this->executeQuery($query);
                //sql injectin??
                return $user_atributes_array = $out->fetchAll();
          }
        
        
        
        public function isUserLoginInDB($log){
            $query = "SELECT 'login' FROM ".DB_USER_TABLE." WHERE `login` = '$log'";
            $out = $this->executeQuery($query);
            //sql injectin??
            $user = $out->fetchAll();
             if(!isset($user) || count($user) == 0){
                 return false;
             } else {
                 return true;
            }
        }
        
        public function registerUserToDB($log, $password){
            // zjistim, zda ho uz nemam v DB
            $user = $this->getUserFromDB_LogPas($log,$password);
            // mohu uzivatele vlozit do DB?
            if(!isset($user) || count($user) == 0){
                /// ziskam vysledek dotazu klasicky
                $query = "INSERT INTO ".DB_USER_TABLE." (login, password) VALUES ('$log', '$password');";
                $this->executeQuery($query);
                return $this->getUserFromDB_LogPas($log, $password)[0];
            } else {
                return null;
            }
        }
        
        
        
        public function getAllUsersFromDB(){
            $query = "SELECT id, login, status, block FROM ".DB_USER_TABLE;
            $out = $this->executeQuery($query);
            //sql injectin??
            $users = $out->fetchAll();
             if(!isset($users) || count($users) == 0){
                 return null;
             } else {
                 return $users;
            }
        }
        
            
    
        public function loginUserToSession($user){
            Session::init();
            echo print_r($user);
            Session::addSession(SS_USER, $user);
            Session::addSession(SS_STATUS_USER, CurrentUser::getStatusCurrentUser($user[0]));
            Session::addSession(SS_LOGIN_STATUS, 'user_logged');
            Session::addSession(SS_TRIED_LOGGIN, 'false');
            header('location: index.php?page=index');
        }
        
        
    }
    
?>