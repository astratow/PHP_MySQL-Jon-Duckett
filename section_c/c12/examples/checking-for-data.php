<?php
require '../cms/includes/database-connection.php';
require '../cms/includes/functions.php';
$sql       = "SELECT forename, surname
                FROM member
               WHERE id = 4;";
$statement = $pdo->query($sql);
$member    = $statement->fetch();
if (!$member) {
    include 'page-not-found.php';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Checking the database returned data</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <p>
      <?= html_escape($member['forename']) ?>
      <?= html_escape($member['surname']) ?>
    </p>
  </body>
</html>