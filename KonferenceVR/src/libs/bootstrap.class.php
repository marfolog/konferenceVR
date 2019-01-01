<?php

class Bootstrap{
    
    function __construct(){
         //PRO PSANI URL V URL RADKU PROHLIZECE- ZOBRAZENI POKUD BUDE VICE NEZ 1 VNORENI index.php?url=
         
        $url = isset($_GET['page']) ? $_GET['page'] : null;;
        $url = rtrim($url, '/');
        $url = explode ('/',$url);
        //print_r($url); //- for the bugging

        
        //pokud neni zadana url (index.php?url=)
        if(empty($url[0])){
            require '../controllers/index.cont.php';
            $controller = new Index();
            $controller->showView();
            return false;
        }

            $file = '../controllers/'.$url[0]. '.cont.php';
            if(file_exists($file)){
                require $file;
                $controller = new $url[0];
                $controller->loadModel($url[0]);
            } else {
                $this->error();
                return;
            }   
        
        
            
        
        //volani metod
            if(isset($url[2])){
                if(method_exists($controller, $url[1])){
                    $controller->{$url[1]}($url[2]);
                    $controller->showView();
                } else {
                    $this->error();
                } 
            } else{
                if(isset($url[1])){
                    if(method_exists($controller, $url[1])){
                        $controller->{$url[1]}();
                        $controller->showView();
                    } else {
                         $this->error();
                    }
                }  else {
                     $controller->showView();
                }
            }
    } 
    
    
    function error(){
        require '../controllers/OwnError.cont.php';
        $controller = new OwnError();
        $controller->showView(); 
        return false;
    }
}
?>