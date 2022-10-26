<?php require_once ROOT.'/Views/layouts/_head.html.php';?>

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Mes annonces</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/annonces">Liste des annonces</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">

                    <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])): ?>

                        <?php if(isset($_SESSION['user']['roles']) && in_array('ROLE_ADMIN',$_SESSION['user']['roles'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">Admin</a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/users/profil">Profil</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/users/logout">Déconnexion</a>
                        </li>

                    <?php else: ?>

                        <li class="nav-item">
                            <a class="nav-link" href="/users/login">Connexion</a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container">

        <?php if(!empty($_SESSION['erreur'])): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['erreur']; unset($_SESSION['erreur'])?>
            </div>
        <?php endif; ?>

        <?php if(!empty($_SESSION['message'])): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $_SESSION['message']; unset($_SESSION['message'])?>
            </div>
        <?php endif; ?>
        
        <?= $content;?>
    </div>


<!------------------------- FOOTER ------------------------->

<?php require_once ROOT.'/Views/layouts/_footer.html.php';?>