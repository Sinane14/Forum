<?php
class Connexion {
    public function verification_connexion($pseudo, $password) {
        global $DB;
        $pseudo = ucfirst(trim($pseudo));
        $password = trim($password);
    
        // Variables déclarées
        $err_pseudo = '';
        $err_password = '';
        $valid = true;
    
        if (empty($pseudo)) {
            $valid = false;
            $err_pseudo = "Ce champ ne peut pas être vide";
        }
    
        if (empty($password)) {
            $valid = false;
            $err_password = "Ce champ ne peut pas être vide";
        }
    
        if ($valid) {
            $req = $DB->prepare("SELECT Password FROM User WHERE Nickname = ?");
            $req->execute(array($pseudo));
            $user_password = $req->fetchColumn();
    
            if (!$user_password) {
                $valid = false;
                $err_pseudo = "La combinaison du pseudo / mot de passe est incorrecte";
            } else {
                // Utiliser la fonction password_verify pour vérifier le mot de passe
                if (!password_verify($password, $user_password)) {
                    $valid = false;
                    $err_pseudo = "La combinaison du pseudo / mot de passe est incorrecte";
                }
            }
        }
    
        if ($valid) {
            $req = $DB->prepare("SELECT * FROM User WHERE Nickname = ?");
            $req->execute(array($pseudo));
            $req_user = $req->fetch();
    
            if ($req_user) {
                $date_connexion = date('Y-m-d H:i:s');
                $req = $DB->prepare("UPDATE User SET date_connexion = ? WHERE ID_user = ?");
                $req->execute(array($date_connexion, $req_user['ID_user']));
    
                $_SESSION['ID_user'] = $req_user['ID_user'];
                $_SESSION['Nickname'] = $req_user['Nickname'];
                $_SESSION['Email_address'] = $req_user['Email_address'];
    
                header('Location: index.php');
                exit;
            } else {
                $valid = false;
                $err_pseudo = "L'identifiant et/ou le mot de passe est incorrect";
            }
        }
    
        return [$err_pseudo, $err_password];
    }
}
?>
