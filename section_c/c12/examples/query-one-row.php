<?php
require '../cms/includes/database-connection.php';
require '../cms/includes/functions.php';
$sql       = "SELECT forename, surname
                FROM member
               WHERE id = 1;";
$statement = $pdo->query($sql);
$member    = $statement->fetch();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Getting one row of data from a database</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <p>
      <?= html_escape($member['forename']) ?>
      <?= html_escape($member['surname']) ?>
    </p>
  </body>
</html>