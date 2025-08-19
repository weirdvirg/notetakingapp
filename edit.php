<?php
    require_once 'config/Db.php';
    require_once 'models/Note.php';

    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
        header('Location: index.php');
        exit();
    }

    $database = new Db();
    $db = $database->connect();
    $note = new Note($db);

    $note->id = (int)$_GET['id'];
    $note->readOne();

    if(!$note->title){
      header('Location: index.php');
      exit();
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT NOTES</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Edit: </h1>
  <form method="post" action="<?php echo htmlspecialchars("save.php");?>">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($note->id); ?>"><br>
    <label for="title">Title:</label><br>
    <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($note->title); ?>" required><br>
    <label for="content">Content:</label><br>
    <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($note->content); ?></textarea><br>
    <input type="submit" value="Save">
  </form>
</body>
</html>