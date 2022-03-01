<?php
$stars   = '';
$message = '';
$star_ratings = [1, 2, 3, 4, 5,];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stars   = $_POST['stars'] ?? '';
    $valid   = in_array($stars, $star_ratings);
    $message = $valid ? 'Thank you' : 'Select an option';
}
?>
<?php include 'includes/header.php'; ?>

<?= $message ?>
<form action="validate-options.php" method="POST">
  Star rating:
  <?php foreach ($star_ratings as $option) { ?>
      <?= $option ?> <input type="radio" name="stars"
            value="<?= $option ?>"
            <?= ($stars == $option) ? 'checked' : '' ?>>
  <?php } ?>
  <input type="submit" value="Save">
</form>

<?php include 'includes/footer.php'; ?>