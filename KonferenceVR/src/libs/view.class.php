 <?php 
    /*třída která volá požadovanou stránku*/
    class View {
        
        
        function __construct(){
        }
        
         /*Zobrazení stránky*/
         public function render($name){
             require '../views/header.php';
             require '../views/content/' .$name.'.php'; 
        }
        
        
        

    }
        
?>