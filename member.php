<?php
    require_once('include.php');

    $req_sql = "SELECT *
        FROM User";

    if(isset($_SESSION['ID_user'])){
        $req_sql .= "WHERE  <> ?";
    }
    
    $req = $DB->prepare($req_sql);

    if(isset($_SESSION['ID_user'])){
        $req->execute([$_SESSION['ID_user']]);
    }else{
        $req->execute();
    }


    $req_member = $req->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        require_once('head/meta.php');
        require_once('head/link.php');
        require_once('head/script.php');
    ?>
    <title>Membres - La Click Project</title>
</head>
<body>
    <?php
        require_once('menu/menu.php');
    ?>
    <div class="container">
        <div class="row">

            <div class="col-12">
            <h1>Membres</h1>

            </div>
            <?php
                foreach($req_member as $rm){
                
            ?>
            <div class="col-3">
                <div><?php echo $rm['Nickname'] ?></div>
                <div>
                    <a href="view-profil.php?id=<?= $rm['ID_user'] ?>">Voir profil</a>
                </div>
            </div>
            <?php
                }
            ?>

        </div>
    </div>
    <?php
        require_once('footer/footer.php');
    ?>
</body>
</html>