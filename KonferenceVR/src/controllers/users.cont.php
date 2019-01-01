<?php
    class Users extends Controller {
        
        function __construct(){
            parent::__construct();
            Session::init();
            
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            
            if($logged != "user_logged" && $status!="admin"){
                header('location: index.php?page=index');
                exit;
            }
        }
        
        function showView(){
            $logged = Session::readSession(SS_LOGIN_STATUS);
            $status = CurrentUser::getStatusCurrentUser();
            if($logged != "user_logged" || $status != "admin"){
                header('location: index.php?page=index');
                exit;
            } else {
                $this->view->userList = $this->model->userList();
                $this->view->render("users");
            }  
        }
        
        
        
        function changeStatus($idUser = null){   
            if(isset($_POST['selectStatus'])){
                $status = $_POST['selectStatus'];
                $this->model->changeStatusUser($status, $idUser);
            }  
        }
    
        
        
        function deleteUsers($id){
            $this->model->deleteUsers($id);
        }
        
        function blockUser($id){
            $this->model->blockUser($id);
        }
        
    }
?>