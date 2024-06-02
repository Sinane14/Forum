<?php
require_once('../include.php');

$get_id = (int) $_GET['id'];

if ($get_id <= 0) {
    header('Location: profil/members.php');
    exit;
}

// if(isset($_SESSION['ID_user']) && $get_id == $_SESSION['ID_user']){
//     header('Location: profil.php');
//     exit;
// }

$req = $DB->prepare("SELECT * FROM User WHERE ID_user = ?");
$req->execute([$get_id]);

$req_user = $req->fetch();

if (!$req_user) {
    header('Location: profil/members.php');
    exit;
}

switch ($req_user['Statut']) {
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
    default:
        $Statut = "Inconnu";
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
    <title>Profil de <?= htmlspecialchars($req_user['Nickname']) ?> - La Click Project</title>
</head>
<body>
    <?php
    require_once('../menu/menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Bonjour <?= htmlspecialchars($req_user['Nickname']) ?></h1>
                <div>
                    Date d'inscription : <?= htmlspecialchars($req_user['Date_of_creation']) ?>
                </div>
                <div>
                    Rôle utilisateur : <?= htmlspecialchars($Statut) ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    require_once('../footer/footer.php');
    ?>
</body>
</html>
