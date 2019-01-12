<?php
    class ServiceArticles extends Controller {
        
        function __construct(){
            parent::__construct();
            Session::init();
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            
            if($logged != "user_logged" || $status!="admin"){
                header('location: index.php?page=0');
            }
        }
        
        function showView(){
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            if($logged != "user_logged" || $status != "admin"){
                header('location: index.php?page=0');
                exit;
            } else {
                $this->view->articles = $this->model->getUserArticlesInReviewStatusFromDB();
                $this->view->render("serviceArticles");
            }  
        }
        
     
        
        
        function addReviewer($id_article){
            $firstR = $_POST['select_reviwer_1'];
            $secondR = $_POST['select_reviwer_2'];
            $thirdR = $_POST['select_reviwer_3'];
            echo "<br>".$id_article;
            echo "<br>F: ".$firstR;
            echo "<br>S: ".$secondR;
            echo "<br>T: ".$thirdR;
            
            
            
            if($firstR != 0){
                Session::addSession(SS_TRIED_REVIEW, 'true');
                if($firstR != $secondR && $firstR != $thirdR){
                     Session::addSession(SS_REVIEW_LOG,'ok');
                    $this->model->addReviewer($id_article, $firstR);
                    header('location: index.php?page=8');
                } else {
                    echo "<br>first - id article: ".$id_article;
                    Session::addSession(SS_REVIEW_LOG,'same_or_0');
                    Session::addSession(SS_REVIEW_LOG_ID, $id_article);
                    
                    header('location: index.php?page=8');
                    return;
                }
            }
            
            if($secondR != 0) {
                Session::addSession(SS_TRIED_REVIEW, 'true');
                if($secondR != $firstR && $secondR != $thirdR ){
                    Session::addSession(SS_REVIEW_LOG,'ok');
                    $this->model->addReviewer($id_article, $secondR);
                    header('location: index.php?page=8');
                } else {
                    Session::addSession(SS_REVIEW_LOG,'same_or_0');
                    Session::addSession(SS_REVIEW_LOG_ID, $id_article);
                    header('location: index.php?page=8');
                    return;
                } 
            }
            
            if($thirdR != 0){
                 Session::addSession(SS_TRIED_REVIEW, 'true');
                if($thirdR != $firstR && $thirdR != $secondR){
                    Session::addSession(SS_REVIEW_LOG,'ok');
                    $this->model->addReviewer($id_article, $thirdR);
                    header('location: index.php?page=8');
                } else {
                    Session::addSession(SS_REVIEW_LOG,'same_or_0');
                    Session::addSession(SS_REVIEW_LOG_ID, $id_article);
                    header('location: index.php?page=8');
                    return;
                }
            }
            header('location: index.php?page=8');
    
            
        }
        
        
        
    function verifyLog($id_article){
            if(Session::readSession(SS_TRIED_REVIEW) == 'true' && Session::readSession(SS_REVIEW_LOG_ID) == $id_article){
                switch (Session::readSession(SS_REVIEW_LOG)) {
                        case 'same_or_0':
                            echo "<div class ='articleMessErr'>(Nepřidáno-Stejní recenzenti)</div>";
                            break;
                        default: echo "";
                    }

            } else {
                echo "";
            }   
    }
        
        
    function publicArticle($id_article){
        $this->model->publicArticle($id_article);
        header('location: index.php?page=8');
    }
        
    function declineArticle($id_article){
        $this->model->declineArticle($id_article);
        header('location: index.php?page=8');   
    }
        
    }
?>