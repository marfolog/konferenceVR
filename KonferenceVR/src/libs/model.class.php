<?php 
/*Třída, kde dochází ke komunikaci s databází, jedn áse o třídu mateřskou
, kdy každá stránka má svůj vlastní model a zde jsou společné funkce.
!!!!!!!A dochází zde k připojení k DB!!!!!*/
    class Model {
        
        function __construct(){
            $this->db = new Database();
        }

        

        

//----------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------TOGETHER-----------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------- 
        
         /*Funkci využívá index - pro vrácení všech publikovaných příspěvků - nemá vlastní model*/
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
        
        
        /*
         * Funkce která uživatele přidá do session, aktuálního přihlášeného
         * @param user - uživatel
         */
        public function loginUserToSession($user){
            Session::init();
            Session::addSession(SS_USER, $user);
            Session::addSession(SS_STATUS_USER, CurrentUser::getStatusCurrentUser($user[0]));
            Session::addSession(SS_LOGIN_STATUS, 'user_logged');
            Session::addSession(SS_TRIED_LOGGIN, 'false');
            header('location: index.php?page=0');
        }
        
        
        /*Funkce vykonávající sql dotazy volanaá z každé funkce kde se snažím o komunikaci s databází
         * string dotaz - dotaz
         */
        public function executeQuery($dotaz){
            $dotaz = 
            $res = $this->db->query($dotaz);
            if (!$res) {
                $error = $this->db->errorInfo();
                echo $error[2];
                return "error";
            } else {
                return $res;            
            }
         }
            
        
//---------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------FOR-USERS-------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------
        
        /* 
         * vrátí uživatele z tabulky který se shodují s loginem a heslem
         *
         * @param $log - login - jmeno
         * @param pas - password - heslo
         * OCHRANA PROTI UTOKUM
         */
          public function getUserFromDB_Log($log){
                $query = "SELECT * FROM ".DB_USER_TABLE." WHERE login =:log";
                $out = $this->db->prepare($query);
              
                $log = htmlspecialchars($log);
                $out->execute(array(":log" => $log));
                return $out->fetchAll();
          }
        
            /*
             *vrátí uživatele z tabulky který se shoduje s id
             * @param idUser - id uživatele
             */
          public function getUserFromDB_ID($idUser){
                $query = "SELECT * FROM ".DB_USER_TABLE." WHERE `id` = '$idUser'";
                $out = $this->executeQuery($query);
                return $out->fetchAll();
          }
        
            /*
             * Vrátí uživatele z tabulky které se shoduj íse statusem
             * @param status - status uzivatele
             */
          public function getUsersFromDB_STATUS($status){
                $query = "SELECT * FROM ".DB_USER_TABLE." WHERE `status` = '$status'";
                $out = $this->executeQuery($query);
                return $out->fetchAll();
          }
         
      
  
//----------------------------------------------------------------------------------------------------------------------
//-------------------------------------------------FOR-ARTICLES-------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------        
       
        /*
         * Vráti article z databaze podle id
         *  je volana z ArticlesForRating_Model kde je vyrvoren novy objekt Model
         * @param id clanku
         */
        public function getArticleFromDB_ID($id){
            $query = "SELECT * FROM ".DB_ARTICLES_TABLE." WHERE `id` = '".$id."'";
            $out = $this->executeQuery($query);
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
         * Vráti článek z tabulky review z databaze podle id
         * je volana z ServiceArticles_Model kde je vyrvoren novy objekt Model
         * @param - id clanku
         */
        public function getReviewFromDB_ID_ARTICLE($id_article){
           $query = "SELECT * FROM ".DB_REVIEW_TABLE." WHERE `id_article` = '$id_article'";
            $out = $this->executeQuery($query);
            return  $out->fetchAll();
       }  
        
    }
    
?>