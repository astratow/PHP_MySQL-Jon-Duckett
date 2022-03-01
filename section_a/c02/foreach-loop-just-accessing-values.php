<?php
$best_sellers = ['Toffee', 'Mints', 'Fudge',];
?>
<!DOCTYPE html>
<html>
  <head>
    <title>foreach Loop - Just Accessing Values</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <h2>Best Sellers</h2>
    <?php foreach ($best_sellers as $product) { ?>
      <p><?= $product ?></p>
    <?php } ?>
  </body>
</html>