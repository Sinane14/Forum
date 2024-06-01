<?php
    require_once('include.php');

    if(isset($_SESSION['Nickname'])){
        header("Location: index.php");
        exit;
    }

    if(!empty($_POST)){
        extract($_POST);

        $valid = (boolean) true;
        
        if(isset($_POST['signin'])){

            $pseudo = (String) ucfirst(trim($pseudo));
            $mail = (String) trim($mail);
            $confmail = (String) trim($confmail);
            $password = (String) trim($password);
            $confpassword = (String) trim($confpassword);

            if(empty($pseudo)){
                $valid = false;
                $err_pseudo = "Ce champ ne peut pas être vide";
            
            }elseif(grapheme_strlen($pseudo) < 5){
                $valid = false;
                $err_pseudo = "Le pseudo doit faire plus de 5 caractères";
            
            }elseif(grapheme_strlen($pseudo) > 15){
                $valid = false;
                $err_pseudo = "Le pseudo doit faire au maximum 15 caractères (" . grapheme_strlen($pseudo) . "/15)";
            
            }else{
                $req = $DB->prepare("SELECT ID_user
                    FROM User
                    WHERE Nickname = ?");

                $req->execute(array($pseudo));

                $req = $req->fetch();

                if(isset($req['id'])){
                    $valid = false;
                    $err_pseudo = "Ce pseudo est déjà pris";

                }
            }

            if(empty($mail)){
                $valid = false;
                $err_mail = "Ce champ ne peut pas être vide";
            
            }elseif(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                $valid = false;
                $err_mail = "Format invalide pour cette addresse email";
                
            }elseif($mail <> $confmail){
                $valid = false;
                $err_mail = "Le mail est différent de la confirmation";
            }else{
                $req = $DB->prepare("SELECT ID_user
                    FROM User
                    WHERE Email_address = ?");
                
                $req->execute(array($mail));

                $req = $req->fetch();

                if(isset($req['id'])){
                    $valid = false;
                    $err_mail = "Ce mail est déjà pris";
                }
            }

            if(empty($password)){
                $valid = false;
                $err_password = "Ce champ ne peut pas être vide";
            }elseif($password <> $confpassword){
                $valid = false;
                $err_password = "Le mot de passe est différent de la confirmation";
            }

            if($valid){

                // $crypt_password = crypt($password, '$6$rounds=5000$=6kr:f=3QM^qzC/Nn1nPV y<mJ^Ff^/aid}dTF0h|/?2[9~B_2z>v3%&fo$'); //Cryptage du mot de passe
                $crypt_password = password_hash($password, PASSWORD_ARGON2ID);

                echo $crypt_password . '<br>';

                if (password_verify($password, $crypt_password)){
                    echo 'Le mot de passe est validé !';
                } else { 
                    echo 'Le mot de passe est invalide.';
                }
                $date_creation = date('Y-m-d h:i:s');

                $req = $DB->prepare("INSERT INTO user(Nickname, Email_address, `Password`, Date_of_creation) VALUES (?, ?, ?, ?)");
                $req->execute(array($pseudo, $mail, $crypt_password, $date_creation));

                header('Location: index.php');
                $_SESSION['Nickname']=$pseudo;

                exit;
            }

        }
    }
   
?>
<!doctype html>
<html lang="fr">
  <head>
    <title>Inscription - La Click Project</title>
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
    
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>Inscription</h1>
                <form method="post">
                    <div class="mb-3">
                        <?php if(isset($err_pseudo)){ echo '<div>' . $err_pseudo . '</div>' ; }?>
                        <label class="form-label">Pseudo</label>
                        <input class="form-control" type="text" name="pseudo" value="<?php if(isset($pseudo)){ echo $pseudo; }?>" placeholder="Pseudo"/>
                    </div>

                    <div class="mb-3">
                        <?php if(isset($err_mail)){ echo '<div>' . $err_mail . '</div>' ; }?>
                        <label class="form-label">Mail</label>
                        <input class="form-control" type="email" name="mail" value="<?php if(isset($email)){ echo $email; }?>" placeholder="Mail"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmation du mail</label>
                        <input class="form-control" type="email" name="confmail" value="<?php if(isset($password)){ echo $password; }?>" placeholder="Confirmation du mail"/>
                    </div>

                    <div class="mb-3">
                        <?php if(isset($err_password)){ echo '<div>' . $err_password . '</div>' ; }?>
                        <label class="form-label">Mot de passe</label>
                        <input class="form-control" type="password" name="password" value="<?php if(isset($confmail)){ echo $confmail; }?>" placeholder="Mot de passe"/>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirmation du Mot de passe</label>
                        <input class="form-control" type="password" name="confpassword" value="" placeholder="Confirmation du Mot de passe"/>
                    </div>

                    <div class="mb-3">
                        <button type="submit" name="signin" class="btn btn-primary">Inscription</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <?php
        include_once('footer/footer.php');
    ?>
  </body>
</html>