<?php

    namespace App\Models;

    class CharactersModel extends Model
    {
        protected $character_name;
        protected $character_element;
        protected $character_weapon;
        protected $character_city;
        protected $character_image;
        protected $character_back;
        protected $character_build;


        public function __construct()
        {
            $this->table = 'characters';
        }


        public function getCharacter_name()
        {
                return $this->character_name;
        }

        public function setCharacter_name($character_name)
        {
                $this->character_name = $character_name;

                return $this;
        }

        public function getCharacter_element()
        {
                return $this->character_element;
        }

        public function setCharacter_element($character_element)
        {
                $this->character_element = $character_element;

                return $this;
        }

        public function getCharacter_weapon()
        {
                return $this->character_weapon;
        }

        public function setCharacter_weapon($character_weapon)
        {
                $this->character_weapon = $character_weapon;

                return $this;
        }

        public function getCharacter_city()
        {
                return $this->character_city;
        }

        public function setCharacter_city($character_city)
        {
                $this->character_city = $character_city;

                return $this;
        }

        public function getCharacter_image()
        {
                return $this->character_image;
        }

        public function setCharacter_image($character_image)
        {
                $this->character_image = $character_image;

                return $this;
        }

        public function getCharacter_back()
        {
                return $this->character_back;
        }

        public function setCharacter_back($character_back)
        {
                $this->character_back = $character_back;

                return $this;
        }

        public function getCharacter_build()
        {
                return $this->character_build;
        }

        public function setCharacter_build($character_build)
        {
                $this->character_build = $character_build;

                return $this;
        }
    }

?>