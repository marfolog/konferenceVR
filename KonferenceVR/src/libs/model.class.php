<?php 
    class Model {
        
        public $db;
        
        function __construct(){
            $this->db = new Database();
          //  echo "Create main model.<br>";
        }

        

        

//----------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------TOGETHER-----------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------- 
        
            /*Využívá index - příspěvky - nemá vlastní model*/
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
        
        
        
        public function loginUserToSession($user){
            Session::init();
            Session::addSession(SS_USER, $user);
            Session::addSession(SS_STATUS_USER, CurrentUser::getStatusCurrentUser($user[0]));
            Session::addSession(SS_LOGIN_STATUS, 'user_logged');
            Session::addSession(SS_TRIED_LOGGIN, 'false');
            header('location: index.php?page=0');
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
         
      
  
//----------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------FOR-ARTICLES-------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------        
       
        /*
            Vráti article z databaze podle id
            je volana z ArticlesForRating_Model kde je vyrvoren novy objekt Model
        */
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
        
        
              /*
            Vráti článek z tabulky review z databaze podle id
            je volana z ServiceArticles_Model kde je vyrvoren novy objekt Model
        */
        public function getReviewFromDB_ID_ARTICLE($id_article){
           $query = "SELECT * FROM ".DB_REVIEW_TABLE." WHERE `id_article` = '$id_article'";
            $out = $this->executeQuery($query);
            //sql injectin??
            return $review = $out->fetchAll();
       }
             
  
        
        

        
        
    }
    
?>