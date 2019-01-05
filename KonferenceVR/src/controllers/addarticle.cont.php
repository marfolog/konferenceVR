<?php
    class AddArticle extends Controller {
        
        function __construct(){
            parent::__construct();
            Session::init();
            
            Session::readSession(SS_TRIED_ARTICLE) == 'false';
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            
            if($logged != "user_logged" && $status != "autor"){
                header('location: index.php?page=index');
                exit;
            }
            
        }
        
          function showView(){
            Session::init();
              
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            if($status != "autor"){
                header('location: index.php?page=index');
                exit;
            }  
              
            if(Session::readSession(SS_LOGIN_STATUS) != 'user_logged'){
                    Session::addSession(SS_TRIED_LOGGIN,'false'); 
            }
            
            Session::addSession(SS_TRIED_REGISTER, 'false'); 
            
            $this->view->render('addarticle'); 
  
          }
        
        
          function preprocessingArticle(){
             $this->model->preprocessingArticle();
          }
        
        
        function verifyLog(){
            if(Session::readSession(SS_TRIED_ARTICLE) == 'true'){

                 switch (Session::readSession(SS_FILE)) {
                        case 'not_correct_format':
                            echo "<div class ='articleMessErr'>Soubor není ve formátu pdf</div>";
                            break;
                        case 'error_upload':
                            echo "<div class ='articleMessErr'>Došlo k chybě u nahrání souboru</div>";
                            break;
                        default: echo "";
                    }

                switch (Session::readSession(SS_ARTICLE_LOG)) {
                        case 'abstractIsEmpty':
                            echo "<div class ='articleMessErr'>Doplňte abstrakt příspěvku</div>";
                            break;
                        case 'titleIsEmpty':
                            echo "<div class ='articleMessErr'>Doplňte titulek příspěvku</div>";
                            break;
                        case 'articleReady':
                            echo "<div class ='articleMessSent'>Příspěvek odeslán</div>";
                            break;
                            case 'not_save':
                            echo "<div class ='articleMessSent'>Nepovedlo se uložit do databáze</div>";
                            break;
                        default: echo "";
                    }

            } else {
                echo "";
            }   
    }
        
        
        
        
    }
?>