<?php
$logged_in = true;

if ($logged_in == false) {
    header('Location: login.php');
    exit;
}
?>
<?php include 'includes/header.php'; ?>
  <h1>Members Area</h1>
  <p>Welcome to the members area</p>
<?php include 'includes/footer.php'; ?>