<?php

/*Třída která připojuje k databázi*/
class Database extends PDO{
    
    /*
     * Konstruktor, kde se volá konstruktor překryté třídy PDO
     */
    function __construct(){
        parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    }  
}


?>