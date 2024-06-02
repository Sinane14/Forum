<?php
require_once('../include.php');

if (!isset($_SESSION['ID_user'])) {
    header('Location: /login.php');
    exit;
}

$req = $DB->prepare("SELECT * FROM User WHERE ID_user = ?");
$req->execute([$_SESSION['ID_user']]);
$req_user = $req->fetch();

if (!$req_user) {
    header('Location: /');
    exit;
}

$mail = isset($_POST['mail']) ? trim($_POST['mail']) : $req_user['Email_address']; // Initialisation de $mail
$oldpsd = isset($_POST['oldpsd']) ? trim($_POST['oldpsd']) : ''; // Initialisation de $oldpsd
$psd = isset($_POST['psd']) ? trim($_POST['psd']) : ''; // Initialisation de $psd
$confpsd = isset($_POST['confpsd']) ? trim($_POST['confpsd']) : ''; // Initialisation de $confpsd




if (!empty($_POST)) {
    $valid = true;

    if (isset($_POST['form1'])) {
        $mail = (String) trim($_POST['mail']);

        if ($mail == $req_user['Email_address']) { 
            $valid = false;
        } elseif (!isset($mail)) {
            $valid = false;
            $err_mail = "Ce champ ne peut pas être vide";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $valid = false;
            $err_mail = "Format invalide pour cet email";
        } else {
            $req = $DB->prepare("SELECT ID_user FROM User WHERE Email_address = ?");
            $req->execute([$mail]);
            $result = $req->fetch();

            if ($result) {
                $valid = false;
                $err_mail = "Ce mail n'est pas disponible";
            }
        }

        if ($valid) {
            $req = $DB->prepare('UPDATE User SET Email_address = ? WHERE ID_user = ?');
            $req->execute([$mail, $_SESSION['ID_user']]);
            header('Location: edit-profil.php');
            exit;
        }
    }elseif(isset($_POST['form2'])){
        $oldpsd = (String) trim($oldpsd);
        $psd = (String) trim($psd);
        $confpsd = (String) trim($confpsd);

        if(!isset($oldpsd)){
            $valid = false;
            $err_password = "Ce champs ne peut pas être vide";
        }else{
            $req = $DB->prepare("SELECT 'Password'
                FROM User
                WHERE ID_user = ?");

            $req->execute([$_SESSION['ID_user']]);

            $req = $req->fetch();

            if(isset($req['mdp'])){
                if(!password_verify($psd, $req['mdp'])){
                    $valid = false;
                    $err_pseudo = "L'ancien mot de passe est incorrecte 1";
                }
                
            }else{
                $valid = false;
                $err_pseudo = "L'ancien mot de passe est incorrecte 1";
            }

        }

        if($valid){
            if(empty($psd)){
                $valid = false;
                $err_password = "Ce champ ne peut pas être vide";
            }elseif($psd <> $confpsd){
                $valid = false;
                $err_password = "Le mot de passe est différent de la confirmation";
            }
        }

        if($valid){
            
            $crytp_password = password_hash($psd, PASSWORD_ARGON2ID);
            $req = $DB->prepare('UPDATE User SET Password = ? WHERE ID_user = ?');
            $req->execute([$crytp_password, $_SESSION['ID_user']]);
            header('Location: modifier-profil.php');
            exit;
        }
    }
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
    <title>Modifier mon compte - La Click Project</title>
</head>
<body>
    <?php
    require_once('../menu/menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Modifier mes informations</h1>

                <?php if (isset($err_mail)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($err_mail) ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="mb-3">
                        <input class="form-control" type="email" name="mail" value="<?= htmlspecialchars($mail) ?>"/>
                    </div>
                    <div class="mb-3">
                        <input class="btn btn-primary" type="submit" name="form1" value="Modifier"/>
                    </div>
                </form>
                <br>
                <form method="post">
                    <div class="mb-3">
                        <?php if(isset($err_password)){ echo '<div>' . $err_password . '</div>'; }?>
                        <input class="form-control" type="password" name="oldpsd" value="" placeholder="Votre mot de passe actuel"/>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="psd" value="" placeholder="Nouveau mot de passe"/>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="password" name="confpsd" value="" placeholder="Confirmation du nouveau mot de passe"/>
                    </div>
                    <div class="mn-3">
                        <input class="btn btn-primary" type="submit" name="form2" value="Modifier"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    require_once('../footer/footer.php');
    ?>
</body>
</html>
