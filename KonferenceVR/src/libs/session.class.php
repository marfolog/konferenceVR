<?php


class Session{
    
    /**
     *  Pri vytvoreni objektu zahaji session.
     */
    public static function init(){
        if (session_status() == PHP_SESSION_NONE) {
                session_start();
        }
    }
    
    /**
     *  Funkce pro ulozeni hodnoty do session.
     *  @param string $name Jmeno promenne.
     *  @param object $value Hodnota
     */
    public static function addSession($name, $value){
        $_SESSION[$name] = $value;
    }
    
    /**
     *  Vrati hodnotu dane session nebo null, pokud session neni nastavena.
     *  @param string $name Jmeno promenne.
     *  @return object
     */
    public static function readSession($name){
        if(Session::isSessionSet($name)){ // ano
            //echo " '" .$name."' je v sešně <br>";
            return $_SESSION[$name];
        } else { // ne
            //echo "'".$name."' neni v sešně <br>";
            return null;
        }
    }
    
    /**
     *  Je session nastavena?
     *  @return boolean
     */
    public static function isSessionSet($name){
        return isset($_SESSION[$name]);
    }
    
    
    /**
     *  Odstrani danou session.
     *  @param string $name Jmeno promenne.
     */
    public static function removeSession($name){
        unset($_SESSION[$name]);
    }
    
    /**
     *  Odstrani danou session.
     *  @param string $name Jmeno promenne.
     */
    public static function destroy(){
        session_destroy();
    }
    
}


?>