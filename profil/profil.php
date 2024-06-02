<?php
    require_once('../include.php');

    if(isset($_SESSION['id'])){
        header('location: /');
        exit;
    }

    $req = $DB->prepare("SELECT *
        FROM User
        WHERE  ID_user = ?");

    $req->execute([$_SESSION['ID_user']]);
      
    $req_user = $req->fetch();

    switch($req_user['Statut']){
        
        case 0:
            $Statut = "Utilisateur";
        break;

        case 1:
            $Statut = "Super Admin";       
        break;

        case 2:
            $Statut = "Admin";
        break;

        case 3:
            $Statut = "Modérateur";
        break;

    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        require_once('../head/meta.php');
        require_once('../head/link.php');
        require_once('../head/script.php');
    ?>
    <title>Profil de <?= $req_user['Nickname'] ?> - La Click Project</title>
</head>
<body>
    <?php
        require_once('../menu/menu.php');
    ?>
    <div class="container">
        <div class="row">

            <div class="col-12">
                <h1>Bonjour <?= $req_user['Nickname'] ?></h1>
                <div>
                    Date d'inscription : <?= $req_user['Date_of_creation'] ?>
                </div>
                <div>
                    Rôle utilisateur : <?= $Statut ?>
                </div>
                <div>
                    <a href="profil/edit-profil.php">Modifier mon compte</a>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once('../footer/footer.php');
    ?>
</body>
</html>