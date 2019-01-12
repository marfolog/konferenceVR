 <?php 
  
    class View {
        function __construct(){
            //echo "This is the view! <br>";
        }
        
        
         public function render($name){
             
             require '../views/header.php';
             require '../views/content/' .$name.'.php';
            // require '../views/footer.php';
             
        }
        
        
        

    }
        
?>