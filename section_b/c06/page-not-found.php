<?php
  $cities  = ['London' => '12 Albermarle Street, N2 1DH',
              'Sydney' => '100 Oxford Street, 2021',
              'NYC'    => '1242 7th Street, 10492',];

  $city    = $_GET['city'] ?? '';

  $valid   = array_key_exists($city, $cities);

  if ($valid) {
  	$address = $cities[$city];
  } else {
  	$city    = 'Please select a location';
  	$address = '';
  }
?>

<?php include 'includes/header.php' ?>

<h1>Page not found</h1>
<p>Sorry, we could not find the page you were looking for.</p>

<?php include 'includes/footer.php' ?>