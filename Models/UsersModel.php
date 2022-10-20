<?php

    namespace App\Models;

    class UsersModel extends Model
    {
        protected $id;
        protected $email;
        protected $password;

        public function __construct()
        {
            $class = str_replace(__NAMESPACE__.'\\', '', __CLASS__);
            $this->table = strtolower(str_replace('Model', '',$class));
        }

        // RECUPERER USER A PARTIR DU MAIL
        public function findOneByEmail(string $email)
        {
            return $this->request("SELECT * FROM {$this->table} WHERE email = ?", [$email])->fetch();
        }

        // CREER LA SESSION UTILISATEUR
        public function setSession()
        {
             $_SESSION['user'] = [
                'id' => $this->id,
                'email' => $this->email
             ];
        }


        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }
    }

?>