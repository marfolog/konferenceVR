<?php 
/*Třída reprezentujícího aktuálního přihlášeného uživatele*/
class CurrentUser {
    
        /*
         * Funkce která vrátí ano/ne pokdu je uživatel přihlášen
         */
        public static function isUserLoggedIn(){
            Session::init();
            if(Session::readSession(SS_LOGIN_STATUS) == 'user_logged'){
                return true;
            } else {
                return false;
            }
        }


        /*Funcke vrátí aktuálního uživatele*/
        public static function returnCurrentUser(){
            Session::init();
            if(isUserLoggedIn()) return Session::readSession(SS_USER);
            else null;
        }

        /*Funcke vrátí status uživatele*/
        public static function getStatusCurrentUser(){
             if(CurrentUser::isUserLoggedIn()){
                 return Session::readSession(SS_USER)['status'];
             } else {
                 return null;
             }
        }
        /*Funcke vrátí id uživatele*/
        public static function getIdCurrentUser(){
             if(CurrentUser::isUserLoggedIn()){
                 return Session::readSession(SS_USER)['id'];
             } else {
                 return null;
             }
        }
        /*Funcke vrátí v řetězci status uživatele*/
         public static function getStatusStringCurrentUser(){
             if(CurrentUser::isUserLoggedIn()){
                 if(Session::readSession(SS_USER)['status'] == "admin") return "Administrátor";
                 if(Session::readSession(SS_USER)['status'] == "autor") return "Autor";
                 if(Session::readSession(SS_USER)['status'] == "recenzent") return "Recenzent";
             } else {
                 return null;
             }
        }
    
        /*Funcke vrátí login/jméno uživatele*/
        public static function getNameCurrentUser(){
             if(CurrentUser::isUserLoggedIn()){
                 return Session::readSession(SS_USER)['login'];
             } else {
                 return null;
             }
        }

}
?>