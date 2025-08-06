<?php
    require_once("db.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $title = isset($_POST['title']) ? trim($_POST['title']) : '';
        $content = isset($_POST['content']) ? trim($_POST['content']) : '';
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;

        if (empty($title) || empty($content)) {
            header('Location: index.php');
            exit();
        }

        //if there is an id, update the data but if not, create a new note(the else is an extra, not needed for this project)
        if($id) {
            $sql = 'UPDATE notes SET title = ?, content = ? WHERE id = ?';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $content, $id]);
        }else{
            $sql = 'INSERT INTO notes (title, content) VALUES (?, ?)';
            $stmt = $conn->prepare($sql);
            $stmt->execute([$title, $content]);
        }



        header('Location: index.php');
        exit();
    }else{
        header('Location: index.php');
        exit();
    }
?>