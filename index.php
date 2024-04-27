<?php
    require_once('include.php');

    if(isset($_SESSION['Nickname'])){
      $var = "Bienvenue " . $_SESSION['Nickname'] . " sur le Forum La Click Project !";
    }else{
      header("Location: index1.php");
    }
?>
<!doctype html>
<html lang="fr"> 
  <head>
    <title>Accueil - La Click Project</title>
    <?php
        require_once('head/meta.php');
        require_once('head/link.php');
        require_once('head/script.php');
    ?>
  </head>
  <body>
    <?php
        include_once('menu/menu.php');
    ?>
    <h1><?php echo $var ?></h1>
    <?php
        require_once('footer/footer.php');
    ?>
  </body>
</html>