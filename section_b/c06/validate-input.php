<?php
$settings['flags']                = FILTER_FLAG_ALLOW_HEX;       // Allow hex flag
$settings['options']['min_range'] = 0;                           // Min number option
$settings['options']['max_range'] = 255;                         // Max number option

$number = filter_input(INPUT_POST, 'number', FILTER_VALIDATE_INT, $settings);
?>
<?php include 'includes/header.php'; ?>

<p>Enter a hexadecimal value (e.g. 0xff) <em>OR</em> a number between 0-255</p>

<form action="validate-input.php" method="POST">
  Number: <input type="text" name="number" value="<?= htmlspecialchars($number) ?>">
  <input type="submit" value="Save">
</form>

<?php var_dump($number); ?>

<?php include 'includes/footer.php'; ?>