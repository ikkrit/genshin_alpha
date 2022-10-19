<?php

    namespace App\Controllers;

    abstract class Controller
    {
        public function render(string $file, array $donnees = [])
        {
            // EXTRACTION DONNEES
            extract($donnees);
            // CHEMIN VIEWS
            require_once ROOT.'/Views/'.$file.'.php';
        }
    }

?>