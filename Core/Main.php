<?php

    namespace App\Core;

    use App\Controllers\MainController;

    /**
     * MAIN ROUTEUR
     */

    class Main
    {
        public function start()
        {
            // ON DEMARRE LA SESSION
            session_start();

            // RECUPERATION URL
            $uri = $_SERVER['REQUEST_URI'];

            // VERIF URI ET SI /
            if(!empty($uri) && $uri != '/' && $uri[-1] === '/') {
                // ENLEVE "/"
                $uri = substr($uri,0,-1);
                // RENVOI CODE REDIRECTION PERMA
                http_response_code(301);
                // REDIRECTION URL SANS "/"
                header('Location: '.$uri);
                exit;
            }

            // GESTION PARAMS URL
            // P=CONTROLEUR/METHODE/PARAMETRES
            // PARAMS -> TABLEAU
            $params = [];

            if(isset($_GET['p']))
                $params = explode('/',$_GET['p']);

            if($params[0] != '') {
                // AU MOIN UN PARAMETRE
                // RECUP NOM DU CONTROLEUR A INSTANCIER
                // NAMESPACE/CONTROLEUR/MAJUSCULE
                // (EXEMPLE -> \App\Controllers\HomeController)
                $controller = '\\App\\Controllers\\'.ucfirst(array_shift($params)).'Controller'; 
                class_exists($controller) ? $controller : $controller = '\\App\\Controllers\\ErrorController'; 
                // INSTANCE CONTROLEUR
                $controller = new $controller();
                // RECUPERATION 2eme PARAMS URL
                $action = (isset($params[0])) ? array_shift($params) : 'index';

                if(method_exists($controller, $action)) {
                    // SI AUTRES PARAMS -> PASSE A LA METHODE
                    (isset($params[0])) ? call_user_func_array([$controller,$action], $params) : $controller->$action();
                } else {
                    http_response_code(404);
                    echo "La page est introuvable!!!!";
                }
                
            } else {
                // PAS DE PARAMETRE -> CONTROLEUR PAR DEFAUT
                $controller = new MainController;
                // APPELLE DE LA METHODE INDEX
                $controller->index();
            }

        }
    }

?>