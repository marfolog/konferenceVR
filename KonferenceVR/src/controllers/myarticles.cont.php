<?php
    class MyArticles extends Controller {
        
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
            if(Session::readSession(SS_LOGIN_STATUS) != 'user_logged'){
                    Session::addSession(SS_TRIED_LOGGIN,'false'); 
            }
            Session::addSession(SS_TRIED_REGISTER, 'false'); 
            Session::addSession(SS_TRIED_ARTICLE, 'false'); 
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            if($logged != "user_logged" || $status != "autor"){
                header('location: index.php?page=index');
                exit;
            } else {
                $this->view->myArticles = $this->model->myArticlesList();
                $this->view->render("myarticles");
            }  
         } 
        
        
        
        
        
         function deleteArticle($id){   
          $this->model->deleteArticle($id);  
         } 
         
        
    }
?>