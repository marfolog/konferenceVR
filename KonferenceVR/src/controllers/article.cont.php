<?php
    class Article extends Controller {
        
        function __construct(){
            parent::__construct();
            Session::init();
            
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
            
            $this->view->render('article'); 
  
          }
        
        
        
        
        
          function preprocessingArticle(){
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  $authorOutput = CurrentUser::getNameCurrentUser();
                  $dateOutput =  date("j. n. Y");
                  
                  Session::addSession(SS_TITLE, $_POST['inputTitle']);
                  Session::addSession(SS_ABSTRACT, $_POST['abstract']);
                  
                  if(!isset($_POST['inputTitle']) || $_POST['inputTitle'] == ""){
                      //ERR
                    Session::addSession(SS_TITLE, null);
                      Session::addSession(SS_ARTICLE_LOG,'titleIsEmpty');
                      Session::addSession(SS_TRIED_ARTICLE,'true');
                  } else if(!isset($_POST['abstract']) || $_POST['abstract'] == "") {
                      //ERR
                      Session::addSession(SS_ABSTRACT, null);
                      Session::addSession(SS_ARTICLE_LOG,'abstractIsEmpty');
                      Session::addSession(SS_TRIED_ARTICLE,'true');
                  } else {
                      //Sent
                      Session::addSession(SS_ABSTRACT, null);
                      Session::addSession(SS_TITLE, null);
                      Session::addSession(SS_TRIED_ARTICLE,'true');
                      Session::addSession(SS_ARTICLE_LOG,'articleSent');
                      $inputTitle = $_POST['inputTitle'];
                      $output =  $_POST['abstract'];  
                  }
                  
                  
                 
                }     
              
          }
        
        
        function verifyLog(){
        if(Session::readSession(SS_TRIED_ARTICLE) == 'true'){
            switch (Session::readSession(SS_ARTICLE_LOG)) {
                    case 'abstractIsEmpty':
                        echo "<div class ='articleMessErr'>Doplňte abstrakt příspěvku</div>";
                        break;
                    case 'titleIsEmpty':
                        echo "<div class ='articleMessErr'>Doplňte titulek příspěvku</div>";
                        break;
                    case 'articleSent':
                        echo "<div class ='articleMessSent'>Příspěvek odeslán</div>";
                        break;
                    default: echo "";

                }
        } else {
            echo "";
        }
            
        }
        
        
        
        
    }
?>