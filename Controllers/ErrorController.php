<?php

    namespace App\Controllers;

    class ErrorController extends Controller
    {   
        public function index()
        {
            $this->template = '404';
            $this->render('main/index', []);
        }
    }

?>