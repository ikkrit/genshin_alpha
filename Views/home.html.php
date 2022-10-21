<?php $pages = "home";?>

<!-------------------------- HEAD -------------------------->

<?php require_once ROOT.'/Views/layouts/head.html.php';?>

<!------------------------- NAVBAR ------------------------->

<?php require_once ROOT.'/Views/layouts/nav.html.php';?>

<!------------------------- HEADER ------------------------->

<?php require_once ROOT.'/Views/layouts/header.html.php';?>

<!-------------------------- MAIN -------------------------->

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<!--<div class="text-center">
        <a href="/annonces" class="btn btn-primary">Voir la liste des annonces</a>
    </div>-->