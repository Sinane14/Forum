<?php

    session_start(); //Récupération de toutes les infos sur cette session

    $_SESSION = array(); //Destruction de toutes les variables de session

    session_destroy(); //Destruction de toutes les infos dedans

    header('Location: connexion.php');
    exit;

?>