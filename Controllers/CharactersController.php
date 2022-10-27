<?php

    namespace App\Controllers;

    use App\Core\Form;
    use App\Models\CharactersModel;

    class CharactersController extends Controller
    {
        public function index()
        {
            // INSTANCE -> MODELE -> ANNONCES
            $charactersModel = new CharactersModel;
            // RECHERCHE ANNONCES
            $characters = $charactersModel->findBy(['actif' => 1]);
            // GENERATE VIEWS
            $this->render('characters/characters_index', compact('characters'), 'home', 'characters');
        }

        public function read(int $id)
        {
            // INSTANCE MODEL
            $charactersModel = new CharactersModel;
            // CHERCHER 1 CHARACTERS
            $characters = $charactersModel->find($id);
            // ENVOIE A LA VUE
            $this->render('characters/characters_index', compact('characters'), 'home', 'characters');
        }
    }

?>