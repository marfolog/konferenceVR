<?php
    class ArticlesForRating extends Controller {
        
        function __construct(){
            parent::__construct();
            Session::init();
            
            Session::readSession(SS_TRIED_ARTICLE) == 'false';
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            
            if($logged != "user_logged" && $status != "recenzent"){
                header('location: index.php?page=index');
                exit;
            }
            
        }
        
        
        
         function showView(){   
            if(Session::readSession(SS_LOGIN_STATUS) != 'user_logged'){
                    Session::addSession(SS_TRIED_LOGGIN,'false'); 
            }

            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
             
            if($logged != "user_logged" || $status != "recenzent"){
                header('location: index.php?page=index');
                exit;
            } else {
                 $this->view->articlesForRating = $this->model->getArticlesForRating();
                $this->view->render("articlesForRating");
            }  
         } 
        
        
        
        
        public function rating($id_rating){
            Session::addSession(SS_TRIED_RATING, 'true');
            Session::addSession(SS_RATING_LOG_ID, $id_rating);
            
            if(!isset($_POST['group_1']) || !isset($_POST['group_2']) || !isset($_POST['group_3']) || !isset($_POST['group_4'])){
                Session::addSession(SS_RATING_LOG, "not_choosed");
            } else {
                Session::addSession(SS_RATING_LOG, "ok");
                    $ratingGroup_1 = $_POST['group_1'];
                    $ratingGroup_2 = $_POST['group_2'];
                    $ratingGroup_3 = $_POST['group_3'];
                    $ratingGroup_4 = $_POST['group_4'];
                    $this->model->updateRatingArticle($id_rating, $ratingGroup_1, $ratingGroup_2, $ratingGroup_3, $ratingGroup_4);
            }
            
            header("location: index.php?page=articlesForRating");
        }
        
        
        
        function verifyLog($id_rating){
            if(Session::readSession(SS_TRIED_RATING) == 'true' && Session::readSession(SS_RATING_LOG_ID) == $id_rating){
                switch (Session::readSession(SS_RATING_LOG)) {
                        case 'not_choosed':
                            echo "<div class ='articleMessErr'>Nebylo vše ohodnoceno</div>";
                            break;
                        default: echo "";
                    }

            } else {
                echo "";
            }   
    }
        
        
    }
?>