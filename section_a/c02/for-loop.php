<?php
$price = 1.99;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>for Loop</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <h2>Prices for Multiple Packs</h2>
    <p>
      <?php
      for ($i = 1; $i <= 10; $i++) {
          echo $i;
          echo ' packs cost $';
          echo $price * $i;
          echo '<br>';
      }
      ?>
    </p>
  </body>
</html>