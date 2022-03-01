<?php
require '../cms/includes/database-connection.php';
require '../cms/includes/functions.php';
$sql = "SELECT forename, surname
          FROM member;";
$members = pdo($pdo, $sql)->fetchAll(); 
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Using the pdo() function to get database data</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <?php foreach ($members as $member) { ?>
      <p>
        <?= html_escape($member['forename']) ?>
        <?= html_escape($member['surname']) ?>
      <p>
    <?php } ?>
  </body>
</html>