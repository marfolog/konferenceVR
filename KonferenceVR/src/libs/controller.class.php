<?php 

class Controller {
    
  
    function __construct(){
        
        
        //vytvori konstruktor View
        $this->view = new View();  
        
      
    } 
    
    
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