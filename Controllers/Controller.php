<?php

    namespace App\Controllers;

    abstract class Controller
    {
        public function render(string $file, array $donnees = [])
        {
            // EXTRACTION DONNEES
            var_dump($donnees);
            extract($donnees);

        }
    }

?>