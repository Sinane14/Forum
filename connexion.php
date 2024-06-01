<?php
    require_once('include.php');

    
    if(isset($_SESSION['Nickname'])){
        header("Location: index.php");
        exit;
    }

    if(!empty($_POST)){
        extract($_POST);

        $valid = (boolean) true;
        
        if(isset($_POST['connexion'])){
            
            $pseudo = ucfirst(trim($pseudo));
            $password = trim($password);

            if(empty($pseudo)){
                $valid = false;
                $err_pseudo = "Ce champ ne peut pas être vide";
            }

            if(empty($password)){
                $valid = false;
                $err_password = "Ce champ ne peut pas être vide";
            
            }

            if($valid){
                $req = $DB->prepare("SELECT 'Password'
                    FROM User
                    WHERE Nickname = ?");

                $req->execute(array($pseudo));

                $req = $req->fetch();

                if(isset($req_user['Password'])){
                    if(!password_verify($password, $req['Password'])){
                        $valid = false;
                        $err_pseudo = "La combinaison du pseudo / mot de passe est incorrecte 1";
                    }
                
                } else {
                    $valid;
                    $err_pseudo = "La combinaison du pseudo / mot de passe est incorrecte 2";
                }

            }

            if($valid){

                $req = $DB->prepare("SELECT *
                    FROM User
                    WHERE Nickname = ?");

                $req->execute(array($pseudo));

                $req_user = $req->fetch();

                if(isset($req_user['Nickname'])){
                    $date_connexion = date('Y-m-d H:i:s');

                    $req = $DB->prepare("UPDATE User SET date_connexion = ? WHERE ID_user = ?");
                    $req->execute(array($date_connexion, $req_user['Nickname']));

                    $_SESSION['ID_user'] = $req_user['ID_user'];
                    $_SESSION['Nickname'] = $req_user['Nickname'];
                    $_SESSION['Email_address'] = $req_user['Email_address'];

                    header('Location: index.php');
                    $_SESSION['Nickname']=$pseudo;
                    
                    exit;

                }else{
                    $valid=false;
                    $err_pseudo = "L'identifiant et/ou le mot de passe est incorrect";
                }
            }
        }
    }
        
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php
        require_once('head/meta.php');
        require_once('head/link.php');
        require_once('head/script.php');
    ?>
    <title>Connexion - La Click Project</title>
</head>
<body>
    <?php
        require_once('menu/menu.php');
    ?>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Connexion</h1>
                <form method="post">
                    <div class="mb-3">
                        <?php if(isset($err_pseudo)){ echo '<div>' . $err_pseudo . '</div>' ; }?>
                        <label class="form-label">Pseudo</label>
                        <input class="form-control" type="text" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>" placeholder="Pseudo"/>
                    </div>

                    <div class="mb-3">
                        <?php if(isset($err_password)){ echo '<div>' . $err_password . '</div>' ; }?>
                        <label class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" name="password" value="<?php if(isset($confmail)){ echo $confmail; }?>" placeholder="Mot de passe"/>
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="connexion" class="btn btn-primary">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        require_once('footer/footer.php');
    ?>
</body>
</html>