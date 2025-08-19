<?php

class Note {
    const TABLE_NAME = "notes";
    private $conn;
    public $id;
    public $title;
    public $content;
    public $create_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $sql = "SELECT * FROM ".self::TABLE_NAME." ORDER BY create_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $sql = "SELECT * FROM ".self::TABLE_NAME." WHERE id = ?";
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
            $sql = "UPDATE ".self::TABLE_NAME." SET title = :title, content = :content WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(":id", $this->id);
        } else {
            $sql = "INSERT INTO ".self::TABLE_NAME." (title, content) VALUES (:title, :content)";
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