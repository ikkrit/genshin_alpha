<?php

    use App\Autoloader;
    use App\Core\Main;

    // CONST RACINE
    define('ROOT', dirname(__DIR__));

    // IMPORT AUTOLOADER
    require_once ROOT.'../Autoloader.php';
    Autoloader::register();

    // INSTANCE MAIN (ROUTEUR)
    $app = new Main();

    // START APLICATION
    $app->start();
    
                
?>