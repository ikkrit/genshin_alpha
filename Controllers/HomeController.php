<?php

    namespace App\Controllers;

    class HomeController extends Controller
    {
        public function index()
        {
            $this->render('home/home_index', [], 'home', 'home');
        }
    }

?>