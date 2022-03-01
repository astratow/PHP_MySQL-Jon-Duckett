<?php
function calculate_cost($cost, $quantity, $discount = 0, $tax = 20,)
{
    $cost = $cost * $quantity;
    $tax  = $cost * ($tax / 100);
    return ($cost + $tax) - $discount;
}
?>
<!DOCTYPE html>
<html> 
  <head>
    <title>Default Values for Parameters</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <h2>Chocolates</h2>
    <p>Dark chocolate $<?= calculate_cost(quantity: 10, cost: 5, tax: 5, discount: 2) ?></p>
    <p>Milk chocolate $<?= calculate_cost(quantity: 10, cost: 5, tax: 5) ?></p>
    <p>White chocolate $<?= calculate_cost(5, 10, tax: 5) ?></p>
  </body>
</html>