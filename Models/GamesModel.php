<?php

    namespace App\Models;

    class GamesModel extends Model
    {
        protected $games_title;
        protected $games_description;
        protected $games_icon;
        protected $games_image;


        public function __construct()
        {
            $this->table = 'games';
        }


        
    }