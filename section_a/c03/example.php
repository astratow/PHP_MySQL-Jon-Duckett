<?php
declare(strict_types = 1);

$candy = [
    'Toffee' => ['price' => 3, 'stock' => 12],
    'Mints'  => ['price' => 2, 'stock' => 26],
    'Fudge'  => ['price' => 4, 'stock' => 8],
];

$tax = 20;

function get_reorder_message(int $stock): string
{
    return ($stock < 10) ? 'Yes' : 'No';
}

function get_total_value(float $price, int $quantity): float
{
    return $price * $quantity;
}

function get_tax_due(float $price, int $quantity, int $tax = 0): float
{
    return ($price * $quantity) * ($tax / 100);
}
?>
<!DOCTYPE html>
<html> 
  <head>
    <title>Functions Example</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <h2>Stock Control</h2>
    <table>
      <tr>
        <th>Product</th><th>Stock</th><th>Re-order</th><th>Total value</th><th>Tax due</th>
      </tr>
      <?php foreach ($candy as $product => $data) { ?>
        <tr>
          <td><?=  $product ?></td>
          <td><?=  $data['stock'] ?></td>
          <td><?=  get_reorder_message($data['stock']) ?></td>
          <td>$<?= get_total_value($data['price'], $data['stock']) ?></td>
          <td>$<?= get_tax_due($data['price'], $data['stock'], $tax) ?></td>
       </tr>
      <?php } ?>
    </table>
  </body>
</html>