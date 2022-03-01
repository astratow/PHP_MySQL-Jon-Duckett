<?php
$cities  = [
    'London' => '48 Store Street, WC1E 7BS',
    'Sydney' => '151 Oxford Street, 2021',
    'NYC'    => '1242 7th Street, 10492',
];
$city  = $_GET['city'] ?? '';
$valid = array_key_exists($city, $cities);

if (!$valid) {
    http_response_code(404);
    header('Location: page-not-found.php');
    exit;
}
$address = $cities[$city];
?>
<?php include 'includes/header.php' ?>

<?php foreach ($cities as $key => $value) { ?>
  <a href="get-4.php?city=<?= $key ?>"><?= $key ?></a>
<?php } ?>

<h1><?= $city ?></h1>
<p><?= $address ?></p>

<?php include 'includes/footer.php' ?>