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
                    header('Location: /users/users_login');
                    exit;
                }

                // SI UTILISATEUR EXISTE
                $user = $userModel->hydrate($userArray);

                // VERIFICATION PASSWORD
                if(password_verify($_POST['password'], $user->getPassword())) {
                    // PASSWORD CORRECT
                    // ON CREE LA SESSION
                    $user->setSession();
                    header('Location: /');
                    exit;

                } else {
                    // PASSWORD INCORRECT
                    $_SESSION['erreur'] = 'L\'adresse e-mail et/ou le mmot de passe est incorrect';
                    header('Location: /users/users_login');
                    exit;
                }
            }
            

            $form = new Form;

            $form->startForm()
                 ->addLabelFor('email', 'E-mail :')
                 ->addInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
                 ->addLabelFor('pass', 'Mot de passe :')
                 ->addInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
                 ->addButton('Me connecter', ['class' => 'btn btn-primary'])
                 ->endForm();

            $this->render('users/users_login',['loginForm' => $form->create()]);
        }

        // INSCRIPTION DES UTILISATEURS
        public function register()
        {
            // ON VERIFIE SI LE FORMULAIRE EST VALIDE
            if(Form::validate($_POST, ['email', 'password'])) {

                // LE FORMULAIRE EST VALIDE
                $email = strip_tags($_POST['email']);
                $pass = password_hash($_POST['password'], PASSWORD_ARGON2I);

                // ON HYDRATE USER
                $user = new UsersModel;

                $user->setEmail($email)
                     ->setPassword($pass);
                
                // ON STOCKE USER
                $user->create();

            }

            $form = new Form;

            $form ->startForm()
                  ->addLabelFor('email', 'E-mail')
                  ->addInput('email', 'email', ['id' => 'email', 'class' => 'form-control'])
                  ->addLabelFor('pass', 'Mot de passe :')
                  ->addInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
                  ->addButton('M\'inscrire', ['class' => 'btn btn-primary'])
                  ->endForm();

            $this->render('users/users_register', ['registerForm' => $form->create()]);
        }

        // PROFIL DE L'UTILISATEUR
        public function profil() {
            
            // ON VERIFIE SI L'UTILISATEUR EST CONNECTER
            if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])) {

                $id = strip_tags($_SESSION['user']['id']);

                // INSTANCE MODEL
                $usersModel = new UsersModel;
                // CHERCHER LE PROFIL
                $profils = $usersModel->find($id);
                // ENVOIE A LA VUE
                $this->render('users/users_profil', ['profils' => $profils]);

            } else {
                // L'UTILISATEUR N'EST PAS CONNECTER
                $_SESSION['erreur'] = "Vous devez être connecté(e) pour accéder à cette page";
                header('Location: /users/login');
                exit;
            }
        }

        // DECONNEXION DE L'UTILISATEUR
        public function logout() {
            unset($_SESSION['user']);
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit;
        }
    }

?>