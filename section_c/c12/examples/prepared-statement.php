<?php
require '../cms/includes/database-connection.php';
require '../cms/includes/functions.php';
$id        = 1;
$sql       = "SELECT forename, surname 
                FROM member 
               WHERE id = :id;";
$statement = $pdo->prepare($sql);
$statement->execute(['id' => $id]);
$member    = $statement->fetch();
if (!$member) {
    include 'page-not-found.php';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Prepared statements</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <p>
      <?= html_escape($member['forename']) ?>
      <?= html_escape($member['surname']) ?>
    </p>
  </body>
</html>