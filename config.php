<?php 
session_start();
     
       
    try 
    {
        $bdd = new PDO('mysql:host=localhost;port=3306;dbname=tontine','root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo 'good';
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }