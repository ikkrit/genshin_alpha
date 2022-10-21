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

        public function deleteAnnonce(int $id)
        {
            if($this->isAdmin()) {
                
                $annonce = new AnnoncesModel;

                $annonce->delete($id);

                header('Location: '.$_SERVER['HTTP_REFERER']);
            }
        }

        public function activeAnnonce(int $id)
        {
            if($this->isAdmin()) {

                $annoncesModel = new AnnoncesModel;

                $annonceArray = $annoncesModel->find($id);

                if($annonceArray) {

                    $annonce = $annoncesModel->hydrate($annonceArray);

                    $annonce->setActif($annonce->getActif() ? 0 :1);

                    $annonce->update();
                }
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