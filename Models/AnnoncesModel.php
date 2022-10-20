<?php

    namespace App\Models;

    class AnnoncesModel extends Model
    {
        protected $id;
        protected $titre;
        protected $description;
        protected $created_at;
        protected $actif;
        protected $user_id;


        public function __construct()
        {
            $this->table = 'annonces';
        }

    
        public function getId() {
            return $this->id;
        }

        public function setId($id) {
            $this->id = $id;
            return $this;
        }

        public function getTitre() {
            return $this->titre;
        }

        public function setTitre($titre) {
            $this->titre = $titre;
            return $this;
        }

        public function getDescription() {
            return $this->description;
        }

        public function setDescription($description) {
            $this->description = $description;
            return $this;
        }

        public function getCreated_at() {
            return $this->created_at;
        }

        public function setCreated_at($created_at) {
            $this->created_at = $created_at;
            return $this;
        }

        public function getActif() {
            return $this->actif;
        }

        public function setActif($actif) {
            $this->actif = $actif;
            return $this;
        }

        public function getUser_id(): int
        {
                return $this->user_id;
        }

        public function setUser_id(int $user_id): self
        {
                $this->user_id = $user_id;

                return $this;
        }
    }

?>