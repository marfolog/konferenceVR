<?php
    class Index extends Controller {
        
        function __construct(){
            parent::__construct();
        }
        
          function showView(){
            Session::init();
            if(Session::readSession(SS_LOGIN_STATUS) != 'user_logged'){
                    Session::addSession(SS_TRIED_LOGGIN,'false'); 
            }
              
            Session::addSession(SS_TRIED_ARTICLE,'false');
            Session::addSession(SS_TRIED_REGISTER, 'false'); 
            Session::addSession(SS_TRIED_REVIEW, 'false');
            Session::addSession(SS_TRIED_RATING, 'false');
              
            $model = new Model();  
            $this->view->publicArticle = $model->getPublicArticleFromDB();
            $this->view->render('index'); 
  
          }
        
        
        
        
    }
?>