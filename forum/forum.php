<?php
    require_once('../include.php');

    $req = $DB->prepare("SELECT * FROM forum ORDER BY Num");
    $req->execute();
    $req_forum = $req->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        require_once('../head/meta.php');
        require_once('../head/link.php');
        require_once('../head/script.php');
    ?>
    <title>Liste des Topics - La Click Project</title>
</head>
<body>
    <?php
    require_once('../menu/menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Forum</h1>
            </div>
            <?php
                 foreach ($req_forum as $rf) {
            ?>
            <div class="col-3">
                <div><?= htmlspecialchars($rf["Title"]) ?></div>
                <div>
                    <a href="forum/list-topics.php?id=<?= htmlspecialchars($rf['ID_forum']); ?>">Voir topics</a>
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
