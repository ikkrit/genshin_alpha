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
                    $character_name = strip_tags($_POST['character_name']);
                    $character_element = strip_tags($_POST['character_element']);
                    $character_weapon = strip_tags($_POST['character_weapon']);
                    $character_city = strip_tags($_POST['character_city']);
                    $character_image = strip_tags($_POST['character_image']);
                    $character_back = strip_tags($_POST['character_back']);
                    $character_build = strip_tags($_POST['character_build']);

                    // ON INSTANCIE NOTRE MODELE
                    $character = new CharactersModel;

                    // ON HYDRATE
                    $character->setCharacter_name($character_name)
                              ->setCharacter_element($character_element)
                              ->setCharacter_weapon($character_weapon)
                              ->setCharacter_city($character_city)
                              ->setCharacter_image($character_image)
                              ->setCharacter_back($character_back)
                              ->setCharacter_build($character_build)
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
                    $character_name = isset($_POST['character_name']) ? strip_tags($_POST['character_name']) : '';
                    $character_element = isset($_POST['character_element']) ? strip_tags($_POST['character_element']) : '';
                    $character_weapon = isset($_POST['character_weapon']) ? strip_tags($_POST['character_weapon']) : '';
                    $character_city = isset($_POST['character_city']) ? strip_tags($_POST['character_city']) : '';
                    $character_image = isset($_POST['character_image']) ? strip_tags($_POST['character_image']) : '';
                    $character_back = isset($_POST['character_back']) ? strip_tags($_POST['character_back']) : '';
                    $character_build = isset($_POST['character_build']) ? strip_tags($_POST['character_build']) : '';
                }

                $form = new Form;

                $form->startForm()
                     ->addLabelFor('character_name', 'Nom du personnage :')
                     ->addInput('text', 'character_name', [
                        'id' => 'character_name', 
                        'class' => 'form_control',
                        'value' => $character_name
                    ])
                    ->addLabelFor('character_element', 'Element du personnage :')
                    ->addInput('text', 'character_element', [
                       'id' => 'character_element', 
                       'class' => 'form_control',
                       'value' => $character_element
                   ])
                   ->addLabelFor('character_weapon', 'Arme du personnage :')
                   ->addInput('text', 'character_element', [
                       'id' => 'character_element', 
                       'class' => 'form_control',
                       'value' => $character_weapon
                   ])
                   ->addLabelFor('character_city', 'Region du personnage :')
                   ->addInput('text', 'character_city', [
                       'id' => 'character_city', 
                       'class' => 'form_control',
                       'value' => $character_city
                   ])
                   ->addLabelFor('character_image', 'Image du personnage :')
                   ->addInput('text', 'character_image', [
                       'id' => 'character_image', 
                       'class' => 'form_control',
                       'value' => $character_image
                   ])
                   ->addLabelFor('character_weapon', 'background du personnage :')
                   ->addInput('text', 'character_element', [
                       'id' => 'character_element', 
                       'class' => 'form_control',
                       'value' => $character_back
                   ])
                   ->addLabelFor('character_build', 'Build du personnage :')
                   ->addInput('text', 'character_build', [
                       'id' => 'character_build', 
                       'class' => 'form_control',
                       'value' => $character_build
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