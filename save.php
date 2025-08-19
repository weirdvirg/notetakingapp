<?php
    require_once "config/Db.php";
    require_once "models/Note.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $database = new Db();
        $db = $database->connect();
        $note = new Note($db);




        $note->title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $note->content = isset($_POST['content']) ? trim($_POST['content']) : '';
        $note->id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

        if (empty($note->title) || empty($note->content)) {
            header('Location: index.php');
            exit();
        }

        if($note->save()){
            header('Location: index.php');
            exit();
        } else{
            header('Location: index.php');
            exit();
        }

    }else{
        header('Location: index.php');
        exit();
    }
?>