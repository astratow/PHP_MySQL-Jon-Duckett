<?php
$stock = 25;

function get_stock_message($stock)
{
    if ($stock >= 10) {
        return 'Good availability';
    }
    if ($stock > 0 && $stock < 10) {
        return 'Low stock';
    }
    return 'Out of stock';
}
?>
<!DOCTYPE html>
<html> 
  <head>
    <title>Multiple Return Statements</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <h2>Chocolates</h2>
    <p><?= get_stock_message($stock) ?></p>
  </body>
</html>