<?php
echo '<p><i>1: Start of page</i></p>';
$basket['pen']    = 1.20; 
$basket['pencil'] = 0.80; 
$basket['paper']  = 'two';

function total(array $basket): int
{
    echo '<p><i>3: Inside total() function</i></p>';
    $total = 0;
    foreach ($basket as $item => $price) {
        $total = $total + $price;
    }
    return $total;
}

echo '<p><i>2: Before function called</i></p>';
$total = total($basket);
?>
<?php // include 'header.php' ?> 
<h3>Basket</h3>
<p><b>Total: $<?= number_format($total, 2) ?></b></p>
<?php // include 'footer.php' ?> 
<?php echo '<p><i>4: End of page</i></p>'; ?>
<hr>
<p><b>$basket:</b> <?= var_dump($basket) ?></p>
<b>Test total() function: </b>
<?php 
$testbasket['pen']    = 1.20; 
$testbasket['pencil'] = 0.80; 
$testbasket['paper']  = 2;
?>  
<?= total($testbasket) ?>