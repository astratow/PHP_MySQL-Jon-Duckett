<?php
$price    = 7;
$quantity = '0a';
$total    = $price * $quantity;
var_dump($quantity);
?>
<h1>Basket</h1>
Total: $<?= $total ?>