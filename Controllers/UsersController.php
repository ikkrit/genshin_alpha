<?php

    namespace App\Controllers;

    use App\Core\Form;
    use App\Models\UsersModel;

    class UsersController extends Controller
    {
        // CONNEXION UTILISATEURS
        public function login()
        {
            // ON VERIFIE SI LE FORMULAIRE EST COMPLET
            if(Form::validate($_POST, ['email', 'password'])) {

                // LE FORMULAIRE EST COMPLET
                // CHERCHER DANS BDD DE L'UTLISATEUR AVEC LE MAIL
                $userModel = new UsersModel;
                $userArray = $userModel->findOneByEmail(strip_tags($_POST['email']));

                // SI L'UTILISATEUR N'EXISTE PAS
                if(!$userArray) {
                    // MESSAGE ERREUR SESSION
                    $_SESSION['erreur'] = 'L\'adresse e-mail et/ou le mot de passe est incorrect';
                    header('Location: /users/login');
                    exit;
                }

                // SI UTILISATEUR EXISTE
                $user = $userModel->hydrate($userArray);

                // VERIFICATION PASSWORD
                if(password_verify($_POST['password'], $user->getPassword())) {
                    // PASSWORD CORRECT
                    // ON CREE LA SESSION
                    $user->setSession();
                    header('Location: /home');
                    exit;

                } else {
                    // PASSWORD INCORRECT
                    $_SESSION['erreur'] = 'L\'adresse e-mail et/ou le mot de passe est incorrect';
                    header('Location: /users/login');
                    exit;
                }
            }
            

            $form = new Form;

            $form->startForm()
                 ->addLabelFor('email', 'E-mail :')
                 ->addInput('email', 'email', ['class' => 'login__control', 'id' => 'email'])
                 ->addLabelFor('pass', 'Mot de passe :')
                 ->addInput('password', 'password', ['id' => 'pass', 'class' => 'login__control'])
                 ->addButton('Connexion', ['class' => 'btn__control'])
                 ->endForm();

            $this->render('users/users_login',['loginForm' => $form->create()],'home','users');
        }

        // INSCRIPTION DES UTILISATEURS
        public function register()
        {
            // ON VERIFIE SI LE FORMULAIRE EST VALIDE
            if(Form::validate($_POST, ['pseudo','first_name','last_name','email', 'password'])) {
                // LE FORMULAIRE EST VALIDE
                $pseudo = strip_tags($_POST['pseudo']);
                $first_name = strip_tags($_POST['first_name']);
                $last_name = strip_tags($_POST['last_name']);
                $email = strip_tags($_POST['email']);
                $verif_pass = strip_tags($_POST['password']);

                // VERIFICATION PASSWORD
                if(strlen($verif_pass) <= 11 ) {
                    $_SESSION['erreur'] = 'Le mot de passe est trop court';
                    header('Location: /users/register');
                    exit;
                }

                $pass = password_hash($verif_pass, PASSWORD_ARGON2I);

                $user = new UsersModel;

                // ON VERIFIE QUE L'UTILISATEUR EXISTE DEJA
                $verif_email = $user->findOneByEmail($email);
                if($verif_email) {
                    // MESSAGE ERREUR SESSION
                    $_SESSION['erreur'] = 'L\'adresse e-mail est deja utiliser';
                    header('Location: /users/register');
                    exit;
                }

                // ON HYDRATE USER
                $user->setPseudo($pseudo)
                     ->setFirst_name($first_name)
                     ->setLast_name($last_name)
                     ->setEmail($email)
                     ->setPassword($pass);
                
                // ON STOCKE USER
                $user->create();

                $_SESSION['message'] = 'Inscription valider, connectez vous';
                header('Location: /users/login');
                exit;

            }

            $form = new Form;

            $form ->startForm()
                  ->addLabelFor('text', 'pseudo')
                  ->addInput('text', 'pseudo', ['id' => 'pseudo', 'class' => 'register__control','required' => 'required'])
                  ->addLabelFor('text', 'prenom')
                  ->addInput('text', 'first_name', ['id' => 'first_name', 'class' => 'register__control','required' => 'required'])
                  ->addLabelFor('text', 'nom')
                  ->addInput('text', 'last_name', ['id' => 'last_name', 'class' => 'register__control','required' => 'required'])
                  ->addLabelFor('email', 'E-mail')
                  ->addInput('email', 'email', ['id' => 'email', 'class' => 'register__control','required' => 'required'])
                  ->addLabelFor('pass', 'Mot de passe (Minimum 12 caractères):')
                  ->addInput('password', 'password', ['id' => 'pass', 'class' => 'register__control','required' => 'required'])
                  ->addButton('M\'inscrire', ['class' => 'btn__register'])
                  ->endForm();

            $this->render('users/users_register', ['registerForm' => $form->create()],'home','users');
        }

        // PROFIL DE L'UTILISATEUR
        public function profil() {
            
            // ON VERIFIE SI L'UTILISATEUR EST CONNECTER
            if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

                $id = strip_tags($_SESSION['user']['id']);

                // INSTANCE MODEL
                $usersModel = new UsersModel;
                // CHERCHER LE PROFIL
                $profils = $usersModel->find($id,'id');
                // ENVOIE A LA VUE
                $this->render('users/users_profil', ['profils' => $profils], 'default', 'users');

            } else {
                // L'UTILISATEUR N'EST PAS CONNECTER
                $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
                header('Location: /users/login');
                exit;
            }
        }

        // EDITION DE L'AVATAR
        public function editAvatar() {

        }

        // EDITION PROFIL DE L'UTILISATEUR
        public function editProfil() {

        }

        // DECONNEXION DE L'UTILISATEUR
        public function logout() {
            unset($_SESSION['user']);
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit;
        }

        // DELETE PROFIL
        public function deleteUser($id) {
            $user = new UsersModel;
            $user->delete($id);
            
            $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
            header('Location: /users/login');
            exit;

        }
    }

?>