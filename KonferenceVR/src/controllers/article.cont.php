<?php

    /*Kontroler ke strance s příspěvkem který bud editujeme a nebo vytváříme*/
    class Article extends Controller {
        
        /*Konstruktor, kde ověřujeme jeslti se jedná o správného uživatele se statusem*/
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
            Session::init();
              
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            if($status != "autor"){
                header('location: index.php?page=0');
                exit;
            }  
              
            if(Session::readSession(SS_LOGIN_STATUS) != 'user_logged'){
                    Session::addSession(SS_TRIED_LOGGIN,'false'); 
            }
            
            Session::addSession(SS_TRIED_REGISTER, 'false'); 
            $this->view->editArticle =null;
            $this->view->render('article'); 
  
        }
        
        
        /*Zde voláme funkci, která nastaví do session, kterou verzi stránky chceme zobrazit
         * 1. pro přidávání příspěvku
         * 2. pro editaci příspěvku
         * Zde se do session uloží verze první
         */
        function add(){
            Session::addSession(SS_TYPE_ARTICLE_WEB, 'add');
        }

        /*Zde voláme funkci, která nastaví do session, kterou verzi stránky chceme zobrazit
         * 1. pro přidávání příspěvku
         * 2. pro editaci příspěvku
         * Zde se do session uloží verze druhá
         */
        function edit($id){ 
            Session::addSession(SS_TYPE_ARTICLE_WEB, 'edit');
            Session::addSession(SS_EDIT_ARTICLE, $this->model->getArticle($id));
        }
        
        /*
         * Potvrzení příspěvku - funkce která je zavolaná po stiknutí na tlačítko ve tvorbě příspěvku
         *
         */
        function confirmArticle(){
             $this->model->preprocessingArticle(null);
        }
        
        /*
         * Potvrzení příspěvku - funkce která je zavolaná po stiknutí na tlačítko v editaci příspěvku
         *
         */
        function editArticle($id){
            $this->model->preprocessingArticle($id);
        }
        
        /*
         * Funcke která vypisuje chybové hlášky do stránky za určitých okolností, pokud nastanou ve stránce
         *
         */
        function verifyLog($type){
            if(Session::readSession(SS_TRIED_ARTICLE) == 'true'){

                 switch (Session::readSession(SS_FILE)) {
                        case 'non_exist':
                            echo "<div class ='articleMessErr'>Chybí příloha</div>";
                                break;
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