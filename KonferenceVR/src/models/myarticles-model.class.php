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
    
    
    
    
        public function deleteArticle($id){
             $query = "DELETE FROM ".DB_ARTICLES_TABLE." WHERE `id` = '$id'";
             $out = $this->executeQuery($query);
        }
        
}
?>