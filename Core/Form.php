<?php

    namespace App\Core;

    class Form
    {
        private $formCode = '';

        public function create()
        {
            return $this->formCode;
        }

        public static function validate(array $form, array $fields)
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

        private function addAttributes(array $attributes) : string
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
                    $str .= " $attribute=\"$value\"";
                }
            }
            return $str;
        }

        public function startForm(string $method = 'post', string $action = '#', array $attributes = []): self
        {
            // ON CREE LA BALISE FORM
            $this->formCode .= "<form action='$action' method='$method'";

            // ON AJOUTE LES ATTRIBUTES EVENTUELS
            $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

            return $this;
        }

        public function endForm(): self
        {
            $this->formCode .= '</form>';
            return $this;
        }

        public function addLabelFor(string $for, string $text, array $attributes = []): self
        {
            // ON OUVRE LA BALISE
            $this->formCode .= "<label for='$for'";

            // ON AJOUTE LES ATTRIBUTS
            $this->formCode .= $attributes ? $this->addAttributes($attributes): '';

            // ON AJOUTE LE TEXTE
            $this->formCode .= ">$text</label>";

            return $this;
        }

        public function addInput(string $type, string $name, array $attributes = []): self
        {
            // ON OUVRE LA BALISE
            $this->formCode .= "<input type='$type' name='$name'";

            // ON AJOUTE LES ATTRIBUTS
            $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

            return $this;
        }

        public function addTextarea(string $name, string $value = '', array $attributes = [])
        {
            // ON OUVRE LA BALISE
            $this->formCode .= "<textarea name='$name'";

            // ON AJOUTE LES ATTRIBUTS
            $this->formCode .= $attributes ? $this->addAttributes($attributes): '';

            // ON AJOUTE LE TEXTE
            $this->formCode .= ">$value</textarea>";

            return $this;
        }

        public function addSelect(string $name, array $option, array $attributes = []): self
        {
            // ON CREE LE SELECT
            $this->formCode .= "<select name='$name'";

            // ON AJOUTE LES ATTRIBUTS
            $this->formCode .= $attributes ? $this->addAttributes($attributes).'>' : '>';

            // ON AJOUTE LES OPTIONS
            foreach($option as $value => $text) {
                $this->formCode .= "<option value=\"$value\">$text</option>";
            }

            // ON FERME LE SELECT
            $this->formCode .= '</select>';

            return $this;
        }

        public function addButton(string $text, array $attributes = []): self
        {
            // ON OUVRE LE BOUTON
            $this->formCode .= '<button ';

            // ON OUVRE LES ATTRIBUTS
            $this->formCode .= $attributes ? $this->addAttributes($attributes) : '';

            // ON AJOUTE LE TEXTE ET ON FERME
            $this->formCode .= ">$text</button>";

            return $this;
        }
    }

?>