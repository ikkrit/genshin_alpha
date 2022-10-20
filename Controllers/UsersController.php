<?php

    namespace App\Controllers;

    use App\Core\Form;
    use App\Models\UsersModel;

    class UsersController extends Controller
    {
        // CONNEXION UTILISATEURS
        public function login()
        {
            // ON VERIFIE SI LE FORMULAIRE ESR COMPLET
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
                    header('Location: /');
                    exit;

                } else {
                    // PASSWORD INCORRECT
                    $_SESSION['erreur'] = 'L\'adresse e-mail et/ou le mmot de passe est incorrect';
                    header('Location: /users/login');
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

            $this->render('users/login',['loginForm' => $form->create()]);
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

            $this->render('users/register', ['registerForm' => $form->create()]);
        }

        // DECONNEXION DE L'UTILISATEUR
        public function logout() {
            unset($_SESSION['user']);
            header('Location: '.$_SERVER['HTTP_REFERER']);
            exit;
        }
    }

?>