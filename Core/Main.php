<?php

    namespace App\Core;

    class Main
    {
        public function start()
        {
            // RECUP URL
            $uri = $_SERVER['REQUEST_URI'];

            // VERIF URI ET SI /
            if(!empty($uri) && $uri != '/' && $uri[-1] === '/'){
                // ENLEVE "/"
                $uri = substr($uri,0,-1);
                // RENVOI CODE REDIRECTION PERMA
                http_response_code(301);
                // REDIRECTION URL SANS "/"
                header('Location: '.$uri);
            }

            // GESTION PARAMS URL
            // p=controleur/methode/paramètres
            // PARAMS -> TABLEAU
            $params = [];

            if(isset($_GET['p']))
                $params = explode('/',$_GET['p']);

            if($params[0] != '') {
                // RECUP 1 PARAMS MINI
            } else {
                echo "Pas de paramètres";
            }

        }
    }

?>