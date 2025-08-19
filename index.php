<?php
    require_once "config/Db.php";
    require_once "models/Note.php";

    $database = new Db();
    $db = $database->connect();

    $note = new Note($db);
    $stmt = $note->readAll();
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotesAPP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>NOTES: </h1>
    <button><a href="add.php">Add Note</a></button>

    <table>
        <thead>
            <tr>
                <th>TITLE</th>
                <th>TEXT</th>
                <th>DATE</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $noteItem): ?>
                <tr>
                    <td><?php echo htmlspecialchars($noteItem['title']);?></td>
                    <td><?php echo htmlspecialchars($noteItem['content']);?></td>
                    <td><?php echo date('m-d H:i:s', strtotime($noteItem['create_date']));?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $noteItem['id']; ?>">EDIT</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>