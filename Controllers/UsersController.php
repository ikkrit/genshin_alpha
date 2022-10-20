<?php

    namespace App\Controllers;

    use App\Core\Form;
    use App\Models\UsersModel;

    class UsersController extends Controller
    {
        // CONNEXION UTILISATEURS
        public function login()
        {
            $form = new Form;

            $form->startForm()
                 ->addLabelFor('email', 'E-mail :')
                 ->addInput('email', 'email', ['class' => 'form-control', 'id' => 'email'])
                 ->addLabelFor('pass', 'Mot de passe :')
                 ->addInput('password', 'password', ['id' => 'pass', 'class' => 'form-control'])
                 ->addButton('Me connecter', ['class' => 'btn btn-primary'])
                 ->endForm();

            $this->render('users/login',['loginForm' => $form->create()],'home');
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
    }

?>