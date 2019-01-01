<?php
    class Users_Model extends Model{
        
        public function __construct(){
              parent::__construct();
              Session::init();
        }
        
        
        
        public function userList(){
            $users = $this->getAllUsersFromDB();
            if($users != null){
                return $users;
            } else {
                return null;
            }
        }
        
        
        public function deleteUsers($id){
             $query = "DELETE FROM ".DB_USER_TABLE." WHERE `id` = '$id'";
             $out = $this->executeQuery($query);
        }
        
        
        
        public function changeStatusUser($status, $id){
             if($status == 0){
                 $this->changeStatusUserInDB($id, "admin");
             } else if($status == 1){
                 $this->changeStatusUserInDB($id, "autor");
             }else if($status == 2){
                 $this->changeStatusUserInDB($id, "recenzent");
             }
        }
        
        
        
        public function changeStatusUserInDB($id, $status){
              $query = "UPDATE ".DB_USER_TABLE." SET `status` = '$status' WHERE `id` = '$id'";
              $out = $this->executeQuery($query);
              if(Session::readSession(SS_USER)['id'] == $id){
                 if(Session::readSession(SS_USER)['status'] == "admin" && $status != "admin"){
                     $user = $this->getUserFromDB_ID($id);
                     Session::addSession(SS_USER, $user[0]);
                     header('location: index.php?page=index');
                 }  
              }
              header('location: index.php?page=users');
        }
        
        
        public function blockUser($idUser){
            if($this->isBlockedUser($idUser) == true){
                $query = "UPDATE ".DB_USER_TABLE." SET `block`= 'false' WHERE `id` = '$idUser'";
                $out = $this->executeQuery($query); 
            } else {
                $query = "UPDATE `users` SET `block`= 'true' WHERE `id` = '$idUser'";
                $out = $this->executeQuery($query); 
            }
             header('location: index.php?page=users');
           
        }
        
        public function isBlockedUser($idUser){
                $query = "SELECT `block` FROM ".DB_USER_TABLE." WHERE `id` = '$idUser'";
                $out = $this->executeQuery($query); 
                $block = $out->fetchAll();
               // echo "<br> 2. ".$block[0][0]."<br>";
                if(isset($block)){
                    if($block[0][0] == 'true'){
                        return true;
                    } else if ($block[0][0] == 'false'){
                        return false;
                    }   
                }
        }
        
        
       
    
    }

?>