<?php 
class MyArticles_Model extends Model {
    

    public function __construct(){ 
        parent::__construct();
        Session::init();
    }

    
     public function myArticlesList(){
            $myArticleList = $this->getUserArticlesFromDB();
            if($myArticleList != null){
                return $myArticleList;
            } else {
                return null;
            }
        }
    
    
    
//--------------------------------------------------------------------------------------------------------------
//-----------------------------------------------DATABASE-------------------------------------------------------
//-------------------------------------------------------------------------------------------------------------- 
    
    
        public function deleteArticle($id){
            $query = "SELECT path_to_file FROM ".DB_ARTICLES_TABLE." WHERE `id` = '".$id."'";
            $out = $this->executeQuery($query);
            //sql injectin??
            if($out != null || !isset($out)){
                $path = $out->fetchAll();
                 if(isset($path) && count($path) != 0){
                    // echo "Pole: ".print_r($path[0][0]);
                    if ($path[0][0] != "nothing") {
                            unlink($path[0][0]);
                    }
                }
            }
            
             $query = "DELETE FROM ".DB_ARTICLES_TABLE." WHERE `id` = '$id'";
             $out = $this->executeQuery($query);
            
             $query = "DELETE FROM ".DB_REVIEW_TABLE." WHERE `id_article` = '$id'";
             $out = $this->executeQuery($query);
        }
    
    
    
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
        
}
?>