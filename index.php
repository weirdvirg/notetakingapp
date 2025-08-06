<?php
    require_once("db.php");

    
    //Using the prepare and execute method for preventing the sql injection, "this is what i think was unnecessary"
    $stmt = $conn->prepare("SELECT * FROM notes ORDER BY create_date DESC");
    $stmt->execute();
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
            <?php foreach ($notes as $note): ?>
                <tr>
                    <td><?php echo htmlspecialchars($note['title']);?></td>
                    <td><?php echo htmlspecialchars($note['content']);?></td>
                    <td><?php echo date('m-d H:i:s', strtotime($note['create_date']));?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $note['id']; ?>">EDIT</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>