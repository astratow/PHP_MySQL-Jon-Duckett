<?php
$packs = 5;
$price = 1.99;
?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <title>do while Loop</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <h2>Prices for Multiple Packs</h2>
    <p>
    <?php
    do {
        echo $packs;
        echo ' packs cost $';
        echo $price * $packs;
        echo '<br>';
        $packs--;
    } while ($packs > 0);
    ?>
    </p>
  </body>
</html>