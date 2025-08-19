<?php

    /* this is the query i've used for creating the table,
       CREATE TABLE `notes_app`.`notes` (
       `id` INT NOT NULL AUTO_INCREMENT,
       `title` VARCHAR(255) NOT NULL,
       `content` TEXT NULL,
       `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`id`) ) ENGINE=InnoDB;
    */

    class Db {
        private $host = "localhost";
        private $user = "root";
        private $pass = "";
        private $dbname = "notes_app";
        public $conn;

        public function connect(){
            $this->conn = null; 
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname};", $this->user, $this->pass);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error Connecting to database: ". $e->getMessage();
            }
            return $this->conn;
        }

    }