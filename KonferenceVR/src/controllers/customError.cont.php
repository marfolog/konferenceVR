<?php

    class CustomError extends Controller {
        
        function __construct(){
           parent::__construct();
        }
        /*Necháváme zobrazit požadovanou stránku - jendá se zde ochybovou stránku*/
          function showView(){
             $this->view->msg = 'This page doesn\'t exist';
             $this->view->render('error');
         }
        
    }


?>