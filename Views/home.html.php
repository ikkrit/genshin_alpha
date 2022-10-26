<?php require_once ROOT.'/Views/layouts/_head.html.php';?>

<?php require_once ROOT.'/Views/layouts/_nav.html.php';?>

<?php if($page == 'home') require_once ROOT.'/Views/layouts/_header.html.php';?>

<!-------------------------- MAIN -------------------------->

        <div class="message__text">
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
        </div>

        <?= $content;?>

    
<!------------------------- FOOTER ------------------------->

<?php require_once ROOT.'/Views/layouts/_footer.html.php';?>


    


