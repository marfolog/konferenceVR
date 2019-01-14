<?php 

/*Třída Kontroler, od ktere dědí ostatní třídy (kontrolery),
  tzv, každá stránka má svůj kontroler a svoji třídu model,
  který se stará o komunikaci s DB*/
class Controller {
    
    /*
     * Vytvoreni konstruktoru a ten vyvori objekt Viee
     */
    function __construct(){        
        
        $this->view = new View();  
    } 
    
    /*
     * Funkce která načítá model, třídu ke každé stránce kde je zapotřebí komunikace s databází
     * @param name - nazev modelu
     */
    public function loadModel($name){ 
        $path= '../models/' .$name. '-model.class.php';
        if(file_exists($path)){
            require $path;
            $modelName = $name.'_Model';
            $this->model = new $modelName();            
        }
    }
}

?>