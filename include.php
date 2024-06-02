<?php
    session_start();

    include_once('bdd/connexiondb.php');
    include_once('class/signin.php');
    include_once('class/connexion.php');

    //Déclaration des classes sous forme de variables

    $Signin = new Signin;
    $Connexion = new Connexion;

?>