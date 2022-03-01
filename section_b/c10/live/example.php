<?php
include 'includes/functions.php';
$price         = 12;
$exchange_rate = 0.8;

// NON-FATAL ERROR CONVERTED TO AN EXCEPTION BY ERROR HANDLER
// Cause:    A string is used in a mathematical operation 
// To test:  Uncomment next line (change back after testing)
// $exchange_rate = 'four';

// FATAL ERROR CONVERTED TO EXCEPTION BY PHP INTERPRETER
// Cause:    Missing class definition when creating object
// To test:  Uncomment next line
// $exchange_rate = new ExchangeRate();


$aud = $price * $exchange_rate;
?>
<?php include 'includes/header.php'; ?>
<p>Price: <?= $price ?></p>
<p>Price in AUD$: <?= $aud; ?></p>
<?php include 'includes/footer.php'; ?>