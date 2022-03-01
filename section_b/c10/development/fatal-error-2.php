<?php
function total(int $price, int $quantity)
{
    return $price * $quantity;
}
?>
<h1>Basket</h1>
<?= totals(3, 5) ?>