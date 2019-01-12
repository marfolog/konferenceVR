<?php

    class CustomError extends Controller {
        
        function __construct(){
           parent::__construct();
        }
        
          function showView(){
             $this->view->msg = 'This page doesn\'t exist';
             $this->view->render('error');
         }
        
    }


?>