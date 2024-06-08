<?php
require_once('../include.php'); // Chemin corrigé pour inclure le fichier

if (!isset($_GET['id'])) {
    header('Location: forum.php'); // Redirection corrigée
    exit;
}

$get_id_forum = (int) $_GET['id'];

if ($get_id_forum <= 0) {
    header('Location: forum.php'); // Redirection corrigée
    exit;
}

$req = $DB->prepare("SELECT * FROM forum WHERE ID_forum = ?");
$req->execute([$get_id_forum]);
$req_forum = $req->fetch();

$req = $DB->prepare("SELECT * FROM topic WHERE ID_forum = ? ORDER BY Date_of_creation DESC");
$req->execute([$get_id_forum]);
$req_list_topics = $req->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        require_once('../head/meta.php'); // Chemin corrigé
        require_once('../head/link.php'); // Chemin corrigé
        require_once('../head/script.php'); // Chemin corrigé
    ?>
    <title>Liste des Topics - <?= htmlspecialchars($req_forum['Title']) ?></title>
</head>
<body>
    <?php
    require_once('../menu/menu.php'); // Chemin corrigé
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?= htmlspecialchars($req_forum['Title']) ?></h1>
            </div>
            <?php
                 foreach ($req_list_topics as $rlt) {
            ?>
            <div class="col-3">
                <div><?= htmlspecialchars($rlt["Title"]) ?></div>
                <div>
                    <a href="topic.php?id=<?= htmlspecialchars($rlt['ID_topic']); ?>">Lire topics</a>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <?php
    require_once('../footer/footer.php'); // Chemin corrigé
    ?>
</body>
</html>
