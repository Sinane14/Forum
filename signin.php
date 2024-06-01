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

            [$err_pseudo, $err_mail, $err_password] = $Signin->verification_inscription($pseudo, $mail, $confmail, $password, $confpassword);
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