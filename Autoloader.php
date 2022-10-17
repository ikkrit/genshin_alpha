<?php

    namespace App;

    class Autoloader
    {
        static function register()
        {
            spl_autoload_register([
                __CLASS__,
                'autoload'
            ]);
        }

        static function autoload($class)
        {
            // RECUPERATION DANS $class DU NAMESPACE EN COURS
            $class = str_replace( __NAMESPACE__ . '\\', '', $class);

            //REMPLACEMENT \ par /
            $class = str_replace('\\', '/', $class);

            $fichier = __DIR__ . '/' . $class . '.php';

            //VERIFICATION SI FICHIER EXISTE
            if(file_exists($fichier)) {

                require_once $fichier;
            }
        }
    }

?>