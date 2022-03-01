<?php
$username = 'Ivy';                                   // Variable to hold username

$greeting = 'Hello, ' . $username . '.';             // Greeting is 'Hello' + username

$offer = [                                           // Create array to hold offer
    'item'     => 'Chocolate',                       // Item on offer
    'qty'      => 5,                                 // Quantity to buy
    'price'    => 5,                                 // Usual price per pack
    'discount' => 4,                                 // Offer price per pack
];

$usual_price = $offer['qty'] * $offer['price'];      // Usual total price
$offer_price = $offer['qty'] * $offer['discount'];   // Offer total price
$saving      = $usual_price - $offer_price;          // Total saving
?>
<!DOCTYPE html>
<html>
  <head>
    <title>The Candy Store</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>

    <h2>Multi-buy Offer</h2>

    <p><?= $greeting ?></p>

    <p class="sticker">Save $<?= $saving ?></p>

    <p>Buy <?= $offer['qty'] ?> packs of <?= $offer['item'] ?> 
      for $<?= $offer_price ?><br> (usual price $<?= $usual_price ?>)</p> 
  </body>
</html>