<?php 


class DataLayer{

    private $connexion;


    function __construct()
    {
        $var = "mysql:host=".HOST.",dbname=".DB_NAME;

        try {
            $this->connexion = new PDO($var,DB_USER,DB_PASSWORD);
            echo "connexion réussie";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}










?>
