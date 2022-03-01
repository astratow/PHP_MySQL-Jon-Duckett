<?php
$tax_rate = 0.2;

function calculate_running_total($price, $quantity) 
{
    global $tax_rate;
    static $running_total = 0;
    $total = $price * $quantity;
    $tax   = $total * $tax_rate;
    $running_total = $running_total + $total + $tax;
    return $running_total;
}
?>
<!DOCTYPE html>
<html> 
  <head>
    <title>Global and Static Variables</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <table>
      <tr><th>Item</th><th>Price</th><th>Qty</th>
        <th>Running total</th></tr>
      <tr><td>Mints:</td><td>$2</td><td>5</td> 
        <td>$<?= calculate_running_total(2, 5) ?></td></tr>
      <tr><td>Toffee:</td><td>$3</td><td>5</td> 
        <td>$<?= calculate_running_total(3, 5) ?></td></tr>
      <tr><td>Fudge:</td><td>$5</td><td>4</td> 
        <td>$<?= calculate_running_total(5, 4) ?></td></tr>
    </table>
  </body>
</html>