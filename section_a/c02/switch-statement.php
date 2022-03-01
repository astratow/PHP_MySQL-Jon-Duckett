<?php
$day = 'Monday';

switch ($day) {
    case 'Monday':
        $offer = '20% off chocolates';
        break;
    case 'Tuesday':
        $offer = '20% off mints';
        break;
    default:
        $offer = 'Buy three packs, get one free';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>switch Statement</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <h1>The Candy Store</h1>
    <h2>Offers on <?= $day; ?></h2>
    <p><?= $offer ?></p>
  </body>
</html>