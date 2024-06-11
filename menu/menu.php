<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="profil/member.php">Membres</a>
                    <?php
                        if(!isset($_SESSION['Nickname'])){
                    ?>
                    <a class="nav-link" href="signin.php">Inscription</a>
                    <a class="nav-link" href="connexion.php">Connexion</a>
                    <?php
                        }else{

                    ?>
                    <a class="nav-link" href="forum/forum.php">Forums</a>
                    <a class="nav-link" href="profil/profil.php">Mon Profil</a>
                    <?php
                        if(in_array($_SESSION['role']. [1, 2])){
                    ?>
                        <a class="nav-link" href="profil/profil.php">Admin</a>
                    <?php
                        }
                    ?>
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                    <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
</nav>