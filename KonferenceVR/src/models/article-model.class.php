<?php 
class Article_Model extends Model {
    

    public function __construct(){ 
        parent::__construct();
        Session::init();
    }
    
    

}
?>