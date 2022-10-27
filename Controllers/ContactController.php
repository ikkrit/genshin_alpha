<?php

    namespace App\Controllers;

    class ContactController extends Controller
    {
        public function index()
        {
            $this->render('contact/contact_index', [], 'home', 'contact');
        }
    }

?>