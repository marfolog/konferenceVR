<?php 
    class Model {
        
        public $db;
        
        function __construct(){
            $this->db = new Database();
          //  echo "Create main model.<br>";
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
        

//----------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------TOGETHER-----------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------- 
        
            /*Využívá index - příspěvky*/
          public function getPublicArticleFromDB(){
            $query = "SELECT * FROM ".DB_ARTICLES_TABLE." WHERE `status` = '1'";
            $out = $this->executeQuery($query);
            //sql injectin??
            if($out != null || !isset($out)){
                $articles = $out->fetchAll();
                 if(!isset($articles) || count($articles) == 0){
                     return null;
                 } else {
                     return $articles;
                }
            }
         }
            
        
//----------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------FOR-USERS-----------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------- 
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
        
            
            public function getUsersFromDB_STATUS($status){
                $query = "SELECT * FROM ".DB_USER_TABLE." WHERE `status` = '$status'";
                $out = $this->executeQuery($query);
                //sql injectin??
                return $user_atributes_array = $out->fetchAll();
          }
        
        
           public function getReviewFromDB_ID_ARTICLE($id_article){
               $query = "SELECT * FROM ".DB_REVIEW_TABLE." WHERE `id_article` = '$id_article'";
                $out = $this->executeQuery($query);
                //sql injectin??
                return $review = $out->fetchAll();
           }
        
            public function getReviewFromDB_ID_REVIEW ($id_reviewer){
               $query = "SELECT * FROM ".DB_REVIEW_TABLE." WHERE `id_reviewer` = '$id_reviewer' AND `total` = '0' ";
               $out = $this->executeQuery($query);
                //sql injectin??
                return $review = $out->fetchAll();
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
            Session::addSession(SS_USER, $user);
            Session::addSession(SS_STATUS_USER, CurrentUser::getStatusCurrentUser($user[0]));
            Session::addSession(SS_LOGIN_STATUS, 'user_logged');
            Session::addSession(SS_TRIED_LOGGIN, 'false');
            header('location: index.php?page=index');
        }
  
//----------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------FOR-ARTICLES-------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------        
        public function getUserArticlesFromDB(){
            $query = "SELECT id, date, author, title, text, path_to_file, status FROM ".DB_ARTICLES_TABLE." WHERE `author` = '".CurrentUser::getNameCurrentUser()."'";
            $out = $this->executeQuery($query);
            //sql injectin??
            if($out != null || !isset($out)){
                $articles = $out->fetchAll();
                 if(!isset($articles) || count($articles) == 0){
                     return null;
                 } else {
                     return $articles;
                }
            }
        }
        
        
    
        
        
       
        
         public function getArticleFromDB_ID($id){
            $query = "SELECT * FROM ".DB_ARTICLES_TABLE." WHERE `id` = '".$id."'";
            $out = $this->executeQuery($query);
            //sql injectin??
            if($out != null || !isset($out)){
                $articles = $out->fetchAll();
                 if(!isset($articles) || count($articles) == 0){
                     return null;
                 } else {
                     return $articles;
                }
            }
        }
        
        
            
 
        
        
        
        /*add article*/
        public function saveArticleToDB($date, $author, $title, $text, $path_to_file){
            if(isset($date) && isset($author) && isset($title) && isset($text) && isset($path_to_file)){
                     $query = "INSERT INTO ".DB_ARTICLES_TABLE." (date, author, title, text, path_to_file) VALUES ('$date', '$author','$title', '$text','$path_to_file');";
                     $this->executeQuery($query);
                    return true; 
                } else {
                    return false;
            } 
        }
        
        /*V service Articles*/
         public function updateStatusArticle($id_article, $status){
            if(isset($id_article) && isset($status)){
                     $query = "UPDATE ".DB_ARTICLES_TABLE." SET `status` = '$status' WHERE `id` = '$id_article'";
                     $this->executeQuery($query);
                    return true; 
                } else {
                    return false;
            } 
        }
        
       
        
        public function editArticleInDB($id, $date, $inputTitle, $output, $dirToFile){
            if(isset($id) && isset($date) && isset($inputTitle) && isset($output) && isset($dirToFile)){
                if($dirToFile == "nothing") {
                    $query = "UPDATE ".DB_ARTICLES_TABLE." SET `status` = '0', date='$date', title='$inputTitle', text='$output' WHERE `id` = '$id'";
                } else {
                    $query = "UPDATE ".DB_ARTICLES_TABLE." SET `status` = '0', date='$date', title='$inputTitle', text='$output', path_to_file='$dirToFile' WHERE `id` = '$id'";
                }   
                $this->executeQuery($query);
                return true; 
            } else {
                echo "vracim nepovedlo se!";
                    return false;
            }
        }
        
 //----------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------FOR-REVIEW-----------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------- 
        public function getUserArticlesInReviewStatusFromDB($status){
            $query = "SELECT id, date, author, title, text, path_to_file, status FROM ".DB_ARTICLES_TABLE." WHERE `status` = '".$status."'";
            $out = $this->executeQuery($query);
            //sql injectin??
            if($out != null || !isset($out)){
                $articles = $out->fetchAll();
                 if(!isset($articles) || count($articles) == 0){
                     return null;
                 } else {
                     return $articles;
                }
            }
        }
        
    }
    
?>