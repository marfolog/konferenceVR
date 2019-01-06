<?php
    class Article extends Controller {
        
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
            $this->view->editArticle =null;
            $this->view->render('article'); 
  
          }
        
        
        function add(){
            Session::addSession(SS_TYPE_ARTICLE_WEB, 'add');
        }

        function edit($id){ 
            Session::addSession(SS_TYPE_ARTICLE_WEB, 'edit');
            Session::addSession(SS_EDIT_ARTICLE, $this->model->getArticle($id));
        }
        
        
        function confirmArticle(){
             $this->model->preprocessingArticle(null);
        }
        
        
        function editArticle($id){
            $this->model->preprocessingArticle($id);
        }
        
        
        function verifyLog($type){
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
                            echo "<div class ='articleMessSent'>";
                            if($type=="edit"){
                                echo "Příspěvek editován - odeslán k posouzení";
                            } else {
                                 echo "Příspěvek odeslán k posouzení";
                            } 
                            echo "</div>";
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