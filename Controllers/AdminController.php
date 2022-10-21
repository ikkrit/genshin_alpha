<?php

    namespace App\Controllers;

    use App\Models\AnnoncesModel;

    class AdminController extends Controller
    {
        public function index()
        {
            // ON VERIFIE SI ON EST ADMIN
            if($this->isAdmin()) {
                
                $this->render('admin/index', [], 'admin');
            }
        }

        // AFFICHE LA LISTE DES ANNONCES SOUS FORME DE TABLEAU
        public function annonces()
        {
            if($this->isAdmin()) {

                $annoncesModel = new AnnoncesModel;

                $annonces = $annoncesModel->findAll();

                $this->render('admin/annonces', compact('annonces'), 'admin');
            }
        }

        private function isAdmin()
        {
            // ON VERIFIE SI ON EST CONNECTER ET SI "ROLE_ADMIN" EST DANS NOS RÔLES
            if(isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {

                // ON EST ADMIN
                return true;

            } else {

                // ON N'EST PAS ADMIN
                $_SESSION['erreur'] = "Vous n'avez pas accès à cette zone";
                header('Location: /');
                exit;
            }
        }
    }

?>