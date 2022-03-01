<?php
// Create array of greetings then get random value
$greetings    = ['Hi ', 'Howdy ', 'Hello ', 'Hola ',
                 'Welcome ', 'Ciao ',];
$greeting_key = array_rand($greetings);
$greeting     = $greetings[$greeting_key];

// Array of best sellers, count items, list top items
$bestsellers      = ['notebook', 'pencil', 'ink',];
$bestseller_count = count($bestsellers);
$bestseller_text  = implode(', ', $bestsellers);

// Array holding customer details
$customer     = ['forename' => 'Ivy',
                 'surname'  => 'Stone',
                 'email'    => 'ivy@eg.link', ];

// If you have a customer forename add it to greeting
if (array_key_exists('forename', $customer)) {
    $greeting .= $customer['forename'];
}
?>
<?php include 'includes/header.php'; ?>

  <h1>Best Sellers</h1>
  <p><?= $greeting ?></p>
  <p>Our top <?= $bestseller_count ?> items today are:
    <b><?= $bestseller_text ?></b></p>

<?php include 'includes/footer.php'; ?>