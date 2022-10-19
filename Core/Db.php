<?php

    namespace App\Core;

    //IMPORT PDO
    use PDO;
    use PDOException;

    class Db extends PDO
    {
        private static $inst;

        private const DBHOST = 'localhost';
        private const DBUSER = 'root';
        private const DBPASS = '';
        private const DBNAME = 'demo_poo';

        private function __construct() {

            $_dsn = 'mysql:dbname='.self::DBNAME.';host='.self::DBHOST;
            
            //CONSTRUCTEUR CLASS PDO
            try {

                parent::__construct($_dsn, self::DBUSER, self::DBPASS);

                $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
                $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch(PDOException $e) {

                die($e->getMessage());
            }
        }

        public static function getInstance() {

            if(self::$inst === null) {

                self::$inst = new self();

            } 
            return self::$inst;
        }
    }

?>