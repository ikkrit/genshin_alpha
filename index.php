<?php

    use App\Autoloader;
    use App\Models\AnnoncesModel;

    require_once 'Autoloader.php';
    Autoloader::register();

    $model = new AnnoncesModel;

    $annonce = $model
        ->setTitre('Nouvelle annonce')
        ->setDescription('Nouvelle description')
        ->setActif(1);

    $model->create($annonce);

    var_dump($annonce);

?>