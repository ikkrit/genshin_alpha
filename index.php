<?php

    use App\Autoloader;
    use App\Models\AnnoncesModel;
use App\Models\UsersModel;

    require_once 'Autoloader.php';
    Autoloader::register();

    $model = new UsersModel;

    $user2 = $model
        ->setEmail('contact@nouvefghfglle-techno.fr')
        ->setPassword(password_hash('azefghrty', PASSWORD_ARGON2I));

    $model->create($user2);
    var_dump($user2);
                
?>