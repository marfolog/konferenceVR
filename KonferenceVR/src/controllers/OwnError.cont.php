<?php

    class OwnError extends Controller {
        
        function __construct(){
           parent::__construct();
        }
        
          function showView(){
              $this->view->msg = 'This page doesnt exist';
             $this->view->render('error');
         }
        
    }


?>