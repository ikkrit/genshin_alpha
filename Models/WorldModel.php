<?php

    namespace App\Models;

    class WorldModel extends Model
    {
        protected $character_name;
        protected $character_element;
        protected $character_weapon;
        protected $character_city;
        protected $character_image;
        protected $character_back;


        public function __construct()
        {
            $this->table = 'world';
        }


        
    }

?>