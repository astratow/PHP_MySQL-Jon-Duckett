<?php
$price = 1.99;
?>
<!DOCTYPE html>
<html>
  <head>
    <title>for Loop - Higher Counter</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <h2>Prices for Large Orders</h2>
    <p>
      <?php
      for ($i = 10; $i <= 100; $i = $i + 10) {
          echo $i;
          echo ' packs cost $';
          echo $price * $i;
          echo '<br>';
      }
      ?>
    </p>
  </body>
</html>