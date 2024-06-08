<?php
require_once('../include.php'); // Chemin corrigé pour inclure le fichier

if (!isset($_GET['id'])) {
    header('Location: forum.php'); // Redirection corrigée
    exit;
}

$get_id_topic = (int) $_GET['id'];

if ($get_id_topic <= 0) {
    header('Location: forum.php'); // Redirection corrigée
    exit;
}

$req = $DB->prepare("SELECT * FROM topic WHERE ID_topic = ?");
$req->execute([$get_id_topic]);
$req_topic = $req->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        require_once('../head/meta.php'); // Chemin corrigé
        require_once('../head/link.php'); // Chemin corrigé
        require_once('../head/script.php'); // Chemin corrigé
    ?>
    <title><?= htmlspecialchars($req_topic['Title']) ?></title>
</head>
<body>
    <?php
    require_once('../menu/menu.php'); // Chemin corrigé
    ?>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1><?= htmlspecialchars($req_topic['Title']) ?></h1>
            </div>
            <div class="col-3"></div>
            <div class="col-3"></div>
            <div class="col-6">
                <div><?= nl2br(htmlspecialchars($req_topic["Content"])) ?></div>
                <div><?= htmlspecialchars($req_topic["Date_of_creation"]) ?></div>
            </div>
        </div>
    </div>
</body>
</html>
