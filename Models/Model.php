<?php

    namespace App\Models;

    use App\Db\Db;

    class Model extends Db
    {
        //TABLE BASE DE DONNEES
        protected $table;

        //INSTANCE DB
        private $db;

        //FIND ALL//
        public function findAll() {

            $query = $this->request('SELECT * FROM '. $this->table);
            return $query->fetchAll();
        }

        //FIND BY//
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

        //FIND//
        public function find(int $id) {

            return $this->request("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
        }

        //CREATE//
        public function create(Model $model) {

            $fields = [];
            $inter = [];
            $values = [];

            foreach($model as $field => $value) {

                if($value !== null && $field != 'db' && $field != 'table') {

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

        //UPDATE//
        public function update(int $id, Model $model) {

            $fields = [];
            $values = [];

            foreach($model as $field => $value) {

                if($value !== null && $field != 'db' && $field != 'table') {

                    $fields[] = "$field = ?";
                    $values[] = $value;
                }
            }

            $values[] = $id;

            //FIELDS -> STRING
            $fields_list = implode(', ', $fields);

            //REQUEST
            return $this->request('UPDATE '.$this->table.' SET '.$fields_list.' WHERE id = ?',$values);
        }

        //DELETE
        public function delete(int $id) {

            return $this->request("DELETE FROM {$this->table} WHERE id = ?", [$id]);
        }

        //REQUEST//
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

        //HYDRATE//
        public function hydrate(array $donnees) {

            foreach($donnees as $key => $value) {
                //RECUP SETTER
                $setter = 'set'.ucfirst($key);
                //SI SETTER EXIST
                if(method_exists($this, $setter)) {
                    //CALL SETTER
                    $this->$setter($value);
                }
            }
            return $this;
        }
    }

?>