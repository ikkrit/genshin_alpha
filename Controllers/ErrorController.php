<?php

    namespace App\Controllers;

    class ErrorController extends Controller
    {   
        public function index()
        {
            $this->render('main/index', [], '404');
        }
    }

?>