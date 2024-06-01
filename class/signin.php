<?php
    class Signin{

        public function verification_inscription($pseudo, $mail, $confmail, $password, $confpassword){
            
            global $DB;
    
            //Variables d'entrées
            $pseudo = (String) ucfirst(trim($pseudo));
            $mail = (String) trim($mail);
            $confmail = (String) trim($confmail);
            $password = (String) trim($password);
            $confpassword = (String) trim($confpassword);
            
            // Variables déclarés
            $err_pseudo = (String) '';
            $err_mail = (String) '';
            $err_password = (String) '';
            $valid = (boolean) true;

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
            return [$err_pseudo, $err_mail, $err_password];
        }
        
    }

?>