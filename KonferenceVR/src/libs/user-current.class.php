<?php 

class CurrentUser {
    
        public static function isUserLoggedIn(){
            Session::init();
            if(Session::readSession(SS_LOGIN_STATUS) == 'user_logged'){
                return true;
            } else {
                return false;
            }
        }


        public static function returnCurrentUser(){
            Session::init();
            if(isUserLoggedIn()) return Session::readSession(SS_USER);
            else null;
        }

        public static function getStatusCurrentUser(){
             if(CurrentUser::isUserLoggedIn()){
                 return Session::readSession(SS_USER)['status'];
             } else {
                 return null;
             }
        }
    
        public static function getidCurrentUser(){
             if(CurrentUser::isUserLoggedIn()){
                 return Session::readSession(SS_USER)['id'];
             } else {
                 return null;
             }
        }
    
         public static function getStatusStringCurrentUser(){
             if(CurrentUser::isUserLoggedIn()){
                 if(Session::readSession(SS_USER)['status'] == "admin") return "Administrátor";
                 if(Session::readSession(SS_USER)['status'] == "autor") return "Autor";
                 if(Session::readSession(SS_USER)['status'] == "recenzent") return "Recenzent";
             } else {
                 return null;
             }
        }
    
        public static function getNameCurrentUser(){
             if(CurrentUser::isUserLoggedIn()){
                 return Session::readSession(SS_USER)['login'];
             } else {
                 return null;
             }
        }

}
?>