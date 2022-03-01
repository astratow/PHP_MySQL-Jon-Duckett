<?php
require '../cms/includes/database-connection.php';
require '../cms/includes/functions.php';
require 'classes/Member.php';
$sql = "SELECT forename, surname
          FROM member
         WHERE id = 1;";
$statement = $pdo->query($sql);
$statement->setFetchMode(PDO::FETCH_CLASS, 'Member');
$member = $statement->fetch();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Fetching data into a class of object</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <p><?= html_escape($member->getFullName()) ?></p>
  </body>
</html>