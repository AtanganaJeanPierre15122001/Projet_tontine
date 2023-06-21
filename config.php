<?php 
session_start();
     
       
    try 
    {
        $bdd = new PDO('mysql:host=localhost;port=3307;dbname=tontine','root', 'lemeilleur');
        $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        // echo 'good';
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }