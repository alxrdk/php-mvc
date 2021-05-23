<?php

namespace App;
use \PDO;

    class Database
    {
        private $dbh;
        private $stmt;

        public function __construct($host, $user, $password, $database)
        {

            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_CASE => PDO::CASE_LOWER
             );

            $this->dbh = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $user, $password, $options);
        }

        public function query($sql)
        {
            $this->stmt = $this->dbh->prepare($sql);
            return $this;
        }

        public function bind($param, $value, $type = null)
        {
            if(is_null($type)){

                switch(true){

                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;

                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;

                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;

                    default:
                        $type = PDO::PARAM_STR;
                        break;
                }

            }
            $this->stmt->bindValue($param, $value, $type);
            return $this;
        }

        public function execute()
        {
            return $this->stmt->execute();
        }

       public function getAll()
       {
           $this->execute();
           return $this->stmt->fetchAll();
       }

       public function get()
       {
            $this->execute();
            return $this->stmt->fetch();
       }

       public function count()
       {
           return $this->stmt->rowCount();
       }

    }