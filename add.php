
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD NOTES</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Create a Note: </h1>
  <form method="post" action="<?php echo htmlspecialchars("save.php");?>">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($note['id']); ?>"><br>
    <label for="title">Title:</label><br>
    <input type="text" name="title" id="title"><br>
    <label for="content">Content:</label><br>
                <textarea id="content" name="content" rows="10" required></textarea>
    <input type="submit" value="Save">
  </form>
</body>
</html>