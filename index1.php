<?php
    require_once('include.php');
    $var = "Bienvenue sur le Forum La Click Project !";
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