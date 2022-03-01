<?php
function total(int $price, int $quantity)
{
    return $price * $quantity;
}
?>
<h1>Basket</h1>
<?= total(3) ?>