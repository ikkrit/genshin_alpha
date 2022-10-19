<?php

    namespace App\Core;

    class Form
    {
        private $formCode = '';

        public function create()
        {
            return $this->formCode;
        }

        public function validate(array $form, array $fields)
        {
            foreach($fields as $field) {
                // SI ABSENT OU VIDE
                if(!isset($form[$field]) || empty($form[$field])) {
                    // ON RETURN FALSE
                    return false;
                }
            }
            return true;
        }

        private function addAttribute(array $attributes) : string
        {
            // INIT STRING
            $str = '';
            // LISTING ATTRIBUTES "courts"
            $courts = ['checked','disabled','readonly','multiple','required','autofocus','novalidate','formnovalidate'];

            // BOUCLE ARRAY ATTRIBUTES
            foreach($attributes as $attribute => $value) {
                // SI ATTRIBUTE EST DANS LISTE
                if(in_array($attribute, $courts) && $value == true) {

                    $str .= " $attribute";

                } else {

                    // ON AJOUTE ATTRIBUTE='value'
                    $str .= " $attribute='$value'";
                }
            }
            return $str;
        }

        public function startForm(string $method = 'post', string $action = '#', array $attributes = []): self
        {
            // ON CREE LA BALISE FORM
            $this->formCode .= "<form action='$action' method='$method'";

            // ON AJOUTE LES ATTRIBUTES EVENTUELS
            if($attributes) {
                $this->formCode .= $attributes ? $this->addAttribute($attributes).'>' : '>';

        }
        return $this;
    }

?>