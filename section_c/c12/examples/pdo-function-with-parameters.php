<?php
require '../cms/includes/database-connection.php';
require '../cms/includes/functions.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    include 'page-not-found.php';
}

$sql = "SELECT forename, surname
          FROM member
         WHERE id = :id;";
$member = pdo($pdo, $sql, ['id' => $id])->fetch();

if (!$member) {
    include 'page-not-found.php';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Using functions to get database data 2</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <p>
       <?= html_escape($member['forename']) ?>
       <?= html_escape($member['surname']) ?>
    </p>
  </body>
</html>