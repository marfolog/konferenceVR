<?php
    /*Kontroler pro stránku s vlastními příspěvky*/
    class MyArticles extends Controller {
        
        function __construct(){
            parent::__construct();
            Session::init();
            
            Session::readSession(SS_TRIED_ARTICLE) == 'false';
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            
            if($logged != "user_logged" && $status != "autor"){
                header('location: index.php?page=0');
                exit;
            }
            
        }
        
        
        /*Necháváme zobrazit požadovanou stránku pokud se jedná o správného uživatele*/
         function showView(){   
            if(Session::readSession(SS_LOGIN_STATUS) != 'user_logged'){
                    Session::addSession(SS_TRIED_LOGGIN,'false'); 
            }
            Session::addSession(SS_TRIED_REGISTER, 'false'); 
            Session::addSession(SS_TRIED_ARTICLE, 'false'); 
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            if($logged != "user_logged" || $status != "autor"){
                header('location: index.php?page=0');
                exit;
            } else {
                $this->view->myArticles = $this->model->myArticlesList();
                $this->view->render("myarticles");
            }  
         } 
        
        
        
        
        /*
         * Funkce pro vymazání vlastního příspěvku. Je volaná po stisknutí na tlačítko vymazat
         *
         */
         function deleteArticle($id){   
              $this->model->deleteArticle($id);
              header('location: index.php?page=6');
         } 
         
        
    }
?>