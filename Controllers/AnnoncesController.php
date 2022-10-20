<?php

    namespace App\Controllers;

    use App\Core\Form;
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
                    $annonce = new AnnoncesModel;

                    // ON HYDRATE
                    $annonce->setTitre($titre)
                            ->setDescription($description)
                            ->setUser_id($_SESSION['user']['id']);

                    // ON ENREGISTRE
                    $annonce->create();

                    // REDIRECTION
                    $_SESSION['message'] = "Votre annonce a été enregistrée avec succès";
                    header('Location: /');
                    exit;

                } else {

                    // LE FORMULAIRE EST INCOMPLET
                }

                $form = new Form;

                $form->startForm()
                     ->addLabelFor('titre', 'Titre de l\'annonce :')
                     ->addInput('text', 'titre', ['id' => 'titre', 'class' => 'form-control'])
                     ->addLabelFor('description', 'Texte de l\'annonce')
                     ->addTextarea('description', '', ['id' => 'description', 'class' => 'form-control'])
                     ->addButton('Ajouter', ['class' => 'btn btn-primary'])
                     ->endForm();

                $this->render('annonces/add', ['form' => $form->create()]);


            } else {
                // L'UTILISATEUR N'EST PAS CONNECTER
                $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
                header('Location: /users/login');
                exit;
            }
        }
    }

?>