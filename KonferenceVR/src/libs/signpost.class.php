<?php

class Signpost{
    
    function __construct(){
         //PRO PSANI URL V URL RADKU PROHLIZECE- ZOBRAZENI POKUD BUDE VICE NEZ 1 VNORENI index.php?url=
        require '../config/signpost.conf.php';
        
        $url = isset($_GET['page']) ? $_GET['page'] : null;;
        $url = rtrim($url, '/');
        $url = explode ('/',$url);
        //print_r($url); //- for the bugging
        
        //pokud neni zadana url (index.php?url=)
        if(empty($url[0])){
            require '../controllers/'.$web_pages[0].'.cont.php';
            $controller = new Index();
            $controller->showView();
            return false;
        }
        
        $idPage = (int) $url[0];
       // echo ($idPage)." - pole:".count($web_pages);
        if($idPage < count($web_pages) && $idPage >= 0){
            $file = '../controllers/'.$web_pages[$idPage]. '.cont.php';
            if(file_exists($file)){
                require $file;
                $controller = new $web_pages[$idPage];
                $controller->loadModel($web_pages[$idPage]);
            } else {
                $this->error();
                return;
            }       
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
        require '../config/signpost.conf.php';
        require '../controllers/'.$web_pages[5].'.cont.php';
        $controller = new $web_pages[5]();
        $controller->showView(); 
        return false;
    }
}
?>