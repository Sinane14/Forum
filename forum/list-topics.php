<?php
    require_once('../include.php');

    if(isset($_GET['id'])){
        header('Location: forum.php');
        exit;
    }

    $get_id_forum = (int) $_GET['id'];

    if($get_id_forum <= 0){
        header('Location: forum.php');
        exit;
    }

    $req = $DB->prepare("SELECT *
    FROM forum
    WHERE ID_user = ?");

    $req->execute([$get_id_forum]);

    $req_forum = $req->fetch();

    $req = $DB->prepare("SELECT *
    FROM topic
    WHERE ID_forum = ?
    ORDER BY date_creation DESC");

    $req->execute([$get_id_forum]);

    $req_list_topics = $req->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        require_once('../head/meta.php');
        require_once('../head/link.php');
        require_once('../head/script.php');
    ?>
    <title>Liste des Topics - <?= $req_forum['title'] ?></title>
</head>
<body>
    <?php
    require_once('../menu/menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?= $req_forum['title'] ?></h1>
            </div>
            <?php
                 foreach ($req_list_topics as $rlt) {
            ?>
            <div class="col-3">
                <div><?= htmlspecialchars($rlt["Title"]) ?></div>
                <div>
                    <a href="forum/topics.php?id=<?= htmlspecialchars($rlt['ID_forum']); ?>">Lire topics</a>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
    <?php
    require_once('../footer/footer.php');
    ?>
</body>
</html>
