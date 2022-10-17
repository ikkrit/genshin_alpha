<?php

    namespace App\Models;

    use App\Db\Db;

    class Model extends Db
    {
        //TABLE BASE DE DONNEES
        protected $table;

        //INSTANCE DB
        private $db;


        public function findAll() {

            $query = $this->request('SELECT * FROM '. $this->table);
            return $query->fetchAll();
        }


        public function findBy(array $criteres) {

            $fields = [];
            $values = [];

            //BOUCLE TABLEAU
            foreach($criteres as $field => $value) {

                $fields[] = "$field = ?";
                $values[] = $value;
            }
            
            //FIELDS -> STRING
            $fields_list = implode(' AND ', $fields);

            //REQUEST
            return $this->request('SELECT * FROM '.$this->table.' WHERE '. $fields_list, $values)->fetchAll();
        }


        public function find(int $id) {

            return $this->request("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
        }


        public function create(Model $model) {

            $fields = [];
            $inter = [];
            $values = [];

            foreach($model as $field => $value) {

                if($value != null && $field != 'db' && $field != 'table') {

                    $fields[] = $field;
                    $inter[] = "?";
                    $values[] = $value;
                }
            }

            //FIELDS -> STRING
            $fields_list = implode(', ', $fields);
            $inter_list = implode(', ', $inter);

            //REQUEST
            return $this->request('INSERT INTO '.$this->table.' ('. $fields_list.') VALUES('.$inter_list.')', $values);
        }


        public function request(string $sql, array $attributs = null) {

            //INSTANCE -> DB
            $this->db = Db::getInstance();

            //SI ATTRIBUTS
            if($attributs !== null) {
                //REQUETE
                $query = $this->db->prepare($sql);
                $query->execute($attributs);
                return $query;
                
            } else {

                //REQUETE SIMPLE
                return $this->db->query($sql);
            }
        }
    }

?>