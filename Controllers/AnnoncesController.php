<?php

    namespace App\Controllers;

    use App\Models\AnnoncesModel;

    class AnnoncesController extends Controller
    {   
        public function index()
        {
            // INSTANCE -> MODELE -> ANNONCES
            $annoncesModel = new AnnoncesModel;
            // RECHERCHE ANNONCES
            $annonces = $annoncesModel->findBy(['actif' => 1]);
            // GENERATE VIEWS
            $this->render('annonces/index', compact('annonces'));
        }

        public function read(int $id)
        {
            // INSTANCE MODEL
            $annoncesModel = new AnnoncesModel;
            // CHERCHER 1 ANNONCES
            $annonce = $annoncesModel->find($id);
            // ENVOIE A LA VUE
            $this->render('annonces/read', compact('annonce'));
        }
    }

?>