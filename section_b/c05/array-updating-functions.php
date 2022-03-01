<?php
// Array of items being ordered
$order = ['notebook', 'pencil', 'eraser',];
array_unshift($order, 'scissors'); // Add to start
array_pop($order);                 // Remove last
$items = implode(', ', $order);    // Convert to string

// Array of classes
$classes = ['Patchwork' => 'April 12th',
            'Knitting'  => 'May 4th',
            'Lettering' => 'May 18th',];
array_shift($classes);                   // Remove 1st
$new     = ['Origami'  => 'June 5th',
            'Quilting' => 'June 23rd',]; // New items
$classes = array_merge($classes, $new);  // Add to end
?>
<?php include 'includes/header.php'; ?>

<h1>Order</h1>
<?= $items ?>
<h1>Classes</h1>
<?php foreach($classes as $description => $date) { ?>
  <b><?= $description ?></b> <?= $date ?><br>
<?php } ?>

<?php include 'includes/footer.php'; ?>