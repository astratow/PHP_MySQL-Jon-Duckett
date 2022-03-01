<?php
// Array holding order
$order = ['notebook', 'pencil', 'scissors',
          'eraser', 'ink', 'washi tape',];
sort($order);                    // Sort ascending
$items = implode(', ', $order);  // Convert to text

// Create array holding classes
$classes = ['Patchwork' => 'April 12th',
            'Knitting'  => 'May 4th',
            'Origami'   => 'June 8th',];
ksort($classes);                 // Sort by key
?>
<?php include 'includes/header.php'; ?>

<h1>Order</h1>
<?= $items ?>
<h1>Classes</h1>
<?php foreach($classes as $description => $date) { ?>
  <b><?= $description ?></b> <?= $date ?><br>
<?php } ?>

<?php include 'includes/footer.php'; ?>