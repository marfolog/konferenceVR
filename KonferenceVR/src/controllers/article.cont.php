<?php
    class Article extends Controller {
        
        function __construct(){
            parent::__construct();
            Session::init();
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            
            if($logged != "user_logged" && $status!="autor"){
                header('location: index.php?page=index');
                exit;
            }
            
        }
        
          function showView(){
            Session::init();
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            if($logged != "user_logged" && $status!="autor"){
                header('location: index.php?page=index');
                exit;
            }      
            if(Session::readSession(SS_LOGIN_STATUS) != 'user_logged'){
                    Session::addSession(SS_TRIED_LOGGIN,'false'); 
            }
            
            Session::addSession(SS_TRIED_REGISTER, 'false'); 
            
            $this->view->render('article'); 
  
          }
    }
?>