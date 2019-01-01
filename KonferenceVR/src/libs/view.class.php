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
        
        
        
        
          public function getRuleForSelect($status){
              if($status =="admin"){
                  $out = "<option selected value='0'>Administrátor</option> 
                    <option value='1'>Autor</option>
                    <option value='2'>Recenzent</option>";
              } else if($status =="autor"){
                   $out = "<option value='0'>Administrátor</option> 
                    <option selected value='1'>Autor</option>
                    <option value='2'>Recenzent</option>";
              } else if($status =="recenzent"){
                   $out = "<option selected value='0'>Administrátor</option> 
                    <option value='1'>Autor</option>
                    <option selected value='2'>Recenzent</option>";
              }
            
            return $out;   
         }
    }
        
?>