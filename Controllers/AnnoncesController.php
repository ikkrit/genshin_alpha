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

            $this->render('annonces/index', ['annonces' => $annonces]);
        }
    }

?>