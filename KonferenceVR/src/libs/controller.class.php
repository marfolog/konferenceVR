<?php 

class Controller {
    
    public $model;
    function __construct(){
        
        
        //vytvori konstruktor View
        $this->view = new View();  
        
      
    } 
    
    
    public function loadModel($name){ 
        $path= '../models/' .$name. '-model.class.php';
        if(file_exists($path)){
            require $path;
            $modelName = $name.'_Model';
            //echo "Load model: ".$modelName."<br>";
            $this->model = new $modelName();            
        }else {
            echo "Don't load model.";
        }
    }
}

?>