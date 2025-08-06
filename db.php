<?php

    /* this is the query i've used for creating the table,
       CREATE TABLE `notes_app`.`notes` (
       `id` INT NOT NULL AUTO_INCREMENT,
       `title` VARCHAR(255) NOT NULL,
       `content` TEXT NULL,
       `create_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
       PRIMARY KEY (`id`) ) ENGINE=InnoDB;
    */
    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "notes_app";
    try { 
        $conn = new PDO("mysql:host=$host;dbname=$dbname;", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error connecting to database: ". $e->getMessage());
    }
?>