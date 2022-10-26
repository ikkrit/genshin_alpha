<?php

    namespace App\Models;

    class UsersModel extends Model
    {
        protected $pseudo;
        protected $first_name;
        protected $last_name;
        protected $id;
        protected $email;
        protected $password;
        protected $avatar;
        protected $roles;

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
                'email' => $this->email,
                'roles' => $this->roles
             ];
        }

        public function getPseudo()
        {
                return $this->pseudo;
        }

        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        public function getFirst_name()
        {
                return $this->first_name;
        }

        public function setFirst_name($first_name)
        {
                $this->first_name = $first_name;

                return $this;
        }

        public function getLast_name()
        {
                return $this->last_name;
        }

        public function setLast_name($last_name)
        {
                $this->last_name = $last_name;

                return $this;
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

        public function getAvatar()
        {
                return $this->avatar;
        }

        public function setAvatar($avatar)
        {
                $this->avatar = $avatar;

                return $this;
        }

        public function getRoles(): array
        {
                $roles = $this->roles;

                $roles[] = 'ROLE_USER';

                return array_unique($roles);
        }

        public function setRoles($roles)
        {
                $this->roles = json_decode($roles);

                return $this;
        }

    }

?>