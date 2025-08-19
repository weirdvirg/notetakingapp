<?php

class Note {
    private $conn;
    public $id;
    public $title;
    public $content;
    public $create_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $sql = "SELECT * FROM notes ORDER BY create_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $sql = "SELECT * FROM notes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $this->id = $result["id"];
            $this->title = $result["title"];
            $this->content = $result["content"];
        }
    }

    public function save() {
        $this->title = trim(strip_tags($this->title));
        $this->content = trim(strip_tags($this->content));

        if ($this->id) {
            $sql = "UPDATE notes SET title = :title, content = :content WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(":id", $this->id);
        } else {
            $sql = "INSERT INTO notes (title, content) VALUES (:title, :content)";
            $stmt = $this->conn->prepare($sql);
        }
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":content", $this->content);
        
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}