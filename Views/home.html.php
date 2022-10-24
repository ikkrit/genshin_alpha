<!-------------------------- HEAD -------------------------->

<?php require_once ROOT.'/Views/layouts/_head.html.php';?>

<!------------------------- NAVBAR ------------------------->

<?php require_once ROOT.'/Views/layouts/_nav.html.php';?>

<!------------------------- HEADER ------------------------->

<?php if($page == 'home') require_once ROOT.'/Views/layouts/_header.html.php';?>

<!-------------------------- MAIN -------------------------->

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

    
<!------------------------- FOOTER ------------------------->

<?php require_once ROOT.'/Views/layouts/_footer.html.php';?>

    


