<?php
require '../cms/includes/database-connection.php';             // Create PDO object
require '../cms/includes/functions.php';                       // Functions 
$sql       = "SELECT id, forename, surname, joined, picture FROM member;"; // SQL
$statement = $pdo->query($sql);                                // Run query
$members   = $statement->fetchAll();                           // Get data
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Formatting data in HTML pages</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <div class="member-summary-grid">
      <?php foreach ($members as $member) { ?>
        <div class="member-summary">
          <img src="../cms/uploads/members/<?= html_escape($member['picture'] ?? 'blank.png') ?>"
               alt="<?= html_escape($member['forename']) ?>" class="profile">
          <h2><?= html_escape($member['forename']) ?> <?= html_escape($member['surname']) ?></h2>
          <p>Member since:<br><?= format_date($member['joined']) ?></p>
        </div>
      <?php } ?>
    </div>
  </body>
</html>