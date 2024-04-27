<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php
                        if(!isset($_SESSION['Nickname'])){
                    ?>
                    <a class="nav-link" href="signin.php">Inscription</a>
                    <a class="nav-link" href="connexion.php">Connexion</a>
                    <?php
                        }else{

                    ?>
                    <a class="nav-link" href="logout.php">Déconnexion</a>
                    <?php
                        }
                    ?>
                    
                </div>
            </div>
        </div>
</nav>