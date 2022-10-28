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
            $characters = $charactersModel->find($id, 'characters_id');
            // ENVOIE A LA VUE
            $this->render('characters/characters_read', compact('characters'), 'home', 'characters');
        }

        // AJOUTER UNE ANNONCE
        public function add()
        {
            // ON VERIFIE SI L'UTILISATEUR EST CONNECTER
            if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
                // L'UTILISATEUR EST CONNECTER
                // ON VERIFIE SI Le FORMULAIRE EST COMPLET
                if(Form::validate($_POST, ['titre', 'description'])) {
                    // FORMULAIRE COMPLET
                    // PROTECTION FAILLES ...
                    $titre = strip_tags($_POST['titre']);
                    $description = strip_tags($_POST['description']);

                    // ON INSTANCIE NOTRE MODELE
                    $character = new CharactersModel;

                    // ON HYDRATE
                    $character->setCharacter_name()
                              ->setCharacter_element()
                              ->setCharacter_weapon()
                              ->setCharacter_city()
                              ->setCharacter_image()
                              ->setCharacter_back()
                              ->setCharacter_build()
                              ->setUser_id($_SESSION['user']['id']);

                    // ON ENREGISTRE
                    $character->create();

                    // REDIRECTION
                    $_SESSION['message'] = "Votre annonce a été enregistrée avec succès";
                    header('Location: /');
                    exit;

                } else {

                    // LE FORMULAIRE EST INCOMPLET
                    $_SESSION['erreur'] = !empty($_POST) ? "Le formulaire est incomplet" : '';
                    $titre = isset($_POST['titre']) ? strip_tags($_POST['titre']) : '';
                    $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
                }

                $form = new Form;

                $form->startForm()
                     ->addLabelFor('titre', 'Titre de l\'annonce :')
                     ->addInput('text', 'titre', [
                        'id' => 'titre', 
                        'class' => 'form-control',
                        'value' => $titre
                    ])
                     ->addLabelFor('description', 'Texte de l\'annonce')
                     ->addTextarea('description', $description, [
                        'id' => 'description', 
                        'class' => 'form-control'
                    ])
                     ->addButton('Ajouter', ['class' => 'btn btn-primary'])
                     ->endForm();

                $this->render('annonces/annonces_add', ['form' => $form->create()]);


            } else {
                // L'UTILISATEUR N'EST PAS CONNECTER
                $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
                header('Location: /users/login');
                exit;
            }
        }
    }

?>