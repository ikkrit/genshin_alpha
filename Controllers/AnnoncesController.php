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
            $this->render('annonces/annonces_index', compact('annonces'));
        }

        public function read(int $id)
        {
            // INSTANCE MODEL
            $annoncesModel = new AnnoncesModel;
            // CHERCHER 1 ANNONCES
            $annonce = $annoncesModel->find($id,'id');
            // ENVOIE A LA VUE
            $this->render('annonces/annonces_read', compact('annonce'));
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

        // MODIFIER UNE ANNONCE
        public function modify($id = null)
        {
            if($id == null || !is_int($id)) {
                $_SESSION['erreur'] = "Vous n'avez pas accès à cette page";
                header('Location: /annonces');
                exit;
            }
            // ON VERIFIE SI L'UTILISATEUR EST CONNECTER
            if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {
                // ON VERIFIE SI L'ANNONCE EXISTE DANS LA BASE

                // ON INSTANCIE NOTRE MODELE
                $annoncesModel = new AnnoncesModel;

                // ON CHERCHE L'ANNONCE AVEC L'ID $id
                $annonce = $annoncesModel->find($id, 'id');

                // SI L'ANNONCE N'EXISTE PAS, ON RETOURNE A LA LISTE DES ANNONCES
                if(!$annonce) {
                    http_response_code(404);
                    $_SESSION['erreur'] = "L'annonce recherchée n'existe pas";
                    header('Location: /annonces');
                    exit;
                }

                // ON VERIFIE SI L'UTILISATEUR EST PROPRIETAIRE DE L'ANNONCE OU ADMIN
                if($annonce->user_id !== $_SESSION['user']['id']) {
                    if(!in_array('ROLE_ADMIN', $_SESSION['user']['roles'])) {

                        $_SESSION['erreur'] = "Vous n'avez pas accès à cette page";
                        header('Location: /annonces');
                        exit;
                    }
                }

                // ON TRAITE LE FORMULAIRE
                if(Form::validate($_POST, ['titre', 'description'])) {
                    // PROTECTION XXS
                    $titre = strip_tags($_POST['titre']);
                    $description = strip_tags($_POST['description']);

                    // ON STOCKE L'ANNONCE
                    $annonceModif = new AnnoncesModel;

                    // ON HYDRATE
                    $annonceModif->setId($annonce->id)
                                 ->setTitre($titre)
                                 ->setDescription($description);

                    // ON MET A JOUR L'ANNONCE
                    $annonceModif->update();

                    // ON REDIRIGE
                    $_SESSION['message'] = "Votre annonce a été modidiée avec succès";
                    header('Location: /');
                    exit;
                }

                $form = new Form;

                $form->startForm()
                     ->addLabelFor('titre', 'Titre de l\'annonce :')
                     ->addInput('text', 'titre', [
                        'id' => 'titre', 
                        'class' => 'form-control',
                        'value' => $annonce->titre
                    ])
                     ->addLabelFor('description', 'Texte de l\'annonce')
                     ->addTextarea('description', $annonce->description, [
                        'id' => 'description', 
                        'class' => 'form-control'
                    ])
                     ->addButton('Modifier', ['class' => 'btn btn-primary'])
                     ->endForm();
                
                // ON ENVOIE A LA VUE
                $this->render('annonces/modify', ['form' => $form->create()]);


            } else {
                // L'UTILISATEUR N'EST PAS CONNECTER
                $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
                header('Location: /users/login');
                exit;
            }
        }
    }

?>