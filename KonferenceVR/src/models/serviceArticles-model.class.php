<?php
    class ServiceArticles_Model extends Model {
        
        public function __construct(){
              parent::__construct();
              Session::init();
        }
        
        
        
        /*
            Všechny články, ktere jsou v recnzijním řízení
        */
         public function getUserArticlesInReviewStatus(){
            $articles= $this->getUserArticlesInReviewStatusFromDB(0);
            if($articles != null){
                return $articles;
            } else {
                return null;
            }
        }
       
        
        
        
        
           public static function getAllRecenzentForSlect($id_article, $select) {
               $model = new Model();
               $reviewers = $model->getUsersFromDB_STATUS("recenzent");
               $review =   $model->getReviewFromDB_ID_ARTICLE($id_article);
               $count = 1; 
               print_r($review);
               $out = null;
               
               if( isset($review[$select][1])){
                    $out .= "<option selected value='".$review[$select][1]."'>";
                            if(isset($reviewers) &&  $reviewers > 0){
                                   foreach($reviewers as $key => $value){
                                        if($value['id'] == $review[$select][1]) {
                                             $out .=  $value['login'];
                                        }
                                   }
                            }
                    
                    $out .=  "</option>";
               } else {
                    $out .= "<option selected value='0'>Žádný recenzent</option>";
               }
               
               if(isset($reviewers) &&  $reviewers > 0){
                   foreach($reviewers as $key => $value){
                        $out .="<option value='".$value['id']."'>".$value['login']."</option>";
                        $count = $count + 1;
                   }
                   
               }
              return $out;
        }
        
        public static function haveArticleReview($id_article, $select){
               $model = new Model();
               $review =  $model->getReviewFromDB_ID_ARTICLE($id_article);
                if(count($review) == 0 || !isset($review[$select]['total'])){
                    return 'havent_reviewer';
                } else if(count($review) == 0 || !isset($review[$select]['total']) || $review[$select]['total'] == 0 ){
                    return 'yet_havent';
               } else {
                   return 'have';
               }              
        }
        
        public static function getPointArticleReview($id_article, $select,  $point){
               $model = new Model();
               $review =  $model->getReviewFromDB_ID_ARTICLE($id_article);
                if(count($review) == 0 || $point != 5 && !isset($review[$select]['op_'.$point])){
                    return false;
               } else {
                    if($point == 5){
                        return floatval($review[$select]['total']);
                    } else {
                        return $review[$select]['op_'.$point];
                    }
               }               
        }

        
        
        public function addReviewer($id_article, $id_reviewer){
             $query = "INSERT INTO ".DB_REVIEW_TABLE." (id_reviewer, id_article) VALUES ('$id_reviewer', '$id_article');";
             $this->executeQuery($query);
            
        }
        
        public function inReview($id_article){
            $model = new Model();
            $review = $model->getReviewFromDB_ID_ARTICLE($id_article);
            if(isset($review) &&  count($review) != 0){
                return true;
            } else {
                return false;
            }  
        }
        
        public function publicArticle($id_article) {
            Model::updateStatusArticle($id_article, 1);
        }
        
        public function declineArticle($id_article) {
            Model::updateStatusArticle($id_article, 2);
        }

                  
     }
?>