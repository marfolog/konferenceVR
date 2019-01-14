<?php
    /*třída strající se o stránku se správou příspěvků*/
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
        
        /*Necháváme zobrazit požadovanou stránku pokud se jedná o správného uživatele*/
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
        
     
        
        /*
         * Funkce která se volá, pokdu uživatel  - admin chce přidat příspěvek k posouzení- přidat recenzentům
         *
         */
        function addReviewer($id_article){
            $firstR = $_POST['select_reviwer_1'];
            $secondR = $_POST['select_reviwer_2'];
            $thirdR = $_POST['select_reviwer_3'];
            echo "<br>".$id_article;
            echo "<br>F: ".$firstR;
            echo "<br>S: ".$secondR;
            echo "<br>T: ".$thirdR;
            
            
            /*Ověřování prvního recenzenta*/
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
            /*Ověřování druhého recenzenta*/
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
            /*Ověřování třetího recenzenta*/
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
        
        
        /*
         * Funkce pro výpis hlášek v případě neočekávaných rekací uživatele
         *
         */
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
        
    /*
     * Funkce se zavolá pokud admin stiskne na tlačítko publikvoat příspěvek
     * @param id příspěvku
     */
    function publicArticle($id_article){
        $this->model->publicArticle($id_article);
        header('location: index.php?page=8');
    }
    /*
     * Funkce se zavolá pokud admin stiskne na tlačítko zamítnout příspěvek
     * @param id příspěvku
     */  
    function declineArticle($id_article){
        $this->model->declineArticle($id_article);
        header('location: index.php?page=8');   
    }
        
    }
?>