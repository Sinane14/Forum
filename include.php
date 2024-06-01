<?php
    session_start();

    include_once('bdd/connexiondb.php');
    include_once('class/signin.php');

    //Déclaration des classes sous forme de variables

    $Signin = new Signin;

?>