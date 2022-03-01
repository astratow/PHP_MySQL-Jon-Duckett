<?php
require '../cms/includes/database-connection.php';
require '../cms/includes/functions.php';
$sql = "SELECT id, forename, surname 
          FROM member;";                  // SQL
$statement = $pdo->query($sql);           // Execute
$statement->setFetchMode(PDO::FETCH_OBJ); // Fetch mode
$members   = $statement->fetchAll();      // Get data
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Fetching data as objects</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <?php foreach ($members as $member) { ?>
      <p>
        <?= html_escape($member->forename) ?>
        <?= html_escape($member->surname) ?>
      </p>
    <?php } ?>
  </body>
</html>