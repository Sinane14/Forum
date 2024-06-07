<?php
class Signin {
    private $valid;
    private $err_pseudo;
    private $err_mail;
    private $err_password;

    public function verification_inscription($pseudo, $mail, $confmail, $password, $confpassword) {
        global $DB;

        // Variables d'entrées
        $pseudo = ucfirst(trim($pseudo));
        $mail = trim($mail);
        $confmail = trim($confmail);
        $password = trim($password);
        $confpassword = trim($confpassword);

        // Variables déclarées
        $this->err_pseudo = '';
        $this->err_mail = '';
        $this->err_password = '';
        $this->valid = true;
        
        $this->verification_pseudo($pseudo);
        $this->verification_mail($mail, $confmail);
        $this->verification_password($password, $confpassword);

        if ($this->valid) {
            // Utilisez bcrypt pour créer un hachage sécurisé
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $date_creation = date('Y-m-d H:i:s');

            try {
                $req = $DB->prepare("INSERT INTO User (Nickname, Email_address, Password, Date_of_creation) VALUES (?, ?, ?, ?)");
                $req->execute(array($pseudo, $mail, $hashed_password, $date_creation));

                // Redirigez après l'insertion réussie
                $_SESSION['Nickname'] = $pseudo;
                header('Location: index.php');
                exit;
            } catch (Exception $e) {
                echo 'Erreur : ' . $e->getMessage();
            }
        }

        return [$this->err_pseudo, $this->err_mail, $this->err_password];
    }

    private function verification_pseudo($pseudo) {
        global $DB;

        if (empty($pseudo)) {
            $this->valid = false;
            $this->err_pseudo = "Ce champ ne peut pas être vide";
        } elseif (grapheme_strlen($pseudo) < 5) {
            $this->valid = false;
            $this->err_pseudo = "Le pseudo doit faire plus de 5 caractères";
        } elseif (grapheme_strlen($pseudo) > 15) {
            $this->valid = false;
            $this->err_pseudo = "Le pseudo doit faire au maximum 15 caractères (" . grapheme_strlen($pseudo) . "/15)";
        } else {
            $req = $DB->prepare("SELECT ID_user FROM User WHERE Nickname = ?");
            $req->execute(array($pseudo));
            $req = $req->fetch();

            if (isset($req['ID_user'])) {
                $this->valid = false;
                $this->err_pseudo = "Ce pseudo est déjà pris";
            }
        }
    }

    private function verification_mail($mail, $confmail) {
        global $DB;

        if (empty($mail)) {
            $this->valid = false;
            $this->err_mail = "Ce champ ne peut pas être vide";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $this->valid = false;
            $this->err_mail = "Format invalide pour cette adresse email";
        } elseif ($mail !== $confmail) {
            $this->valid = false;
            $this->err_mail = "Le mail est différent de la confirmation";
        } else {
            $req = $DB->prepare("SELECT ID_user FROM User WHERE Email_address = ?");
            $req->execute(array($mail));
            $req = $req->fetch();

            if (isset($req['ID_user'])) {
                $this->valid = false;
                $this->err_mail = "Ce mail est déjà pris";
            }
        }
    }

    private function verification_password($password, $confpassword) {
        if (empty($password)) {
            $this->valid = false;
            $this->err_password = "Ce champ ne peut pas être vide";
        } elseif ($password !== $confpassword) {
            $this->valid = false;
            $this->err_password = "Le mot de passe est différent de la confirmation";
        }
    }
}
?>
