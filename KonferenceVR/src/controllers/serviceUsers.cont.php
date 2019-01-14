<?php

    /*Třída, kontorler pro správu uživatelů*/
    class ServiceUsers extends Controller {
        
        function __construct(){
            parent::__construct();
            Session::init();
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            
            if($logged != "user_logged" && $status!="admin"){
                header('location: index.php?page=0');
                exit;
            }
        }
        
        /*Necháváme zobrazit požadovanou stránku pokud se jedná o správného uživatele*/
        function showView(){
            Session::addSession(SS_TRIED_REVIEW, 'false');
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            if($logged != "user_logged" || $status != "admin"){
                header('location: index.php?page=0');
                exit;
            } else {
                $this->view->userList = $this->model->userList();
                $this->view->render("serviceUsers");
            }  
        }
        
        
        /*Funcke pro změnu statusu/role/práva uživatele v systému */
        function changeStatus($idUser){   
            if(isset($_POST['selectStatus'])){
                $status = $_POST['selectStatus'];
                $this->model->changeStatusUser($status, $idUser);
            }  
        }
    
        
        /*Funcke pro odstranení uživatele v systému */
        function deleteUsers($id){
            $this->model->deleteUsers($id);
             header('location: index.php?page=9');
        }
        
        /*Funcke pro zablokování uživatele v systému */
        function blockUser($id){
            $this->model->blockUser($id);
             header('location: index.php?page=9');
        }
        
    }
?>