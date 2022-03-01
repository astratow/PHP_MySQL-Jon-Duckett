<?php
$name = 'Ivy';                                   // Store the user's name

$greeting = 'Hello';                             // Create initial value for greeting
if ($name) {                                     // If $name has a value
    $greeting = 'Welcome back, ' . $name;        // Create personalized greeting
}

$product = 'Lollipop';                           // Product name
$cost    = 2;                                    // Cost of single pack

for ($i = 1; $i <= 10; $i++) {
    $subtotal   = $cost * $i;                    // Total for this quantity
    $discount   = ($subtotal / 100) * ($i * 4);  // Discount for this quantity
    $totals[$i] = $subtotal - $discount;         // Add discounted price to indexed array
}
?>

<?php require 'includes/header.php'; ?> 

  <p><?= $greeting ?></p>
  <h2><?= $product ?> Discounts</h2>
  <table>
    <tr>
      <th>Packs</th>
      <th>Price</th>
    </tr>
    <?php foreach ($totals as $quantity => $price) { ?>
    <tr>
      <td>
        <?= $quantity ?>
        pack<?= ($quantity === 1) ? '' : 's'; ?>
      </td>
      <td>
        $<?= $price ?>
      </td>
    </tr>
    <?php } ?>
  </table>

<?php include 'includes/footer.php' ?>