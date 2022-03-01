<?php
$form['email'] = '';                                                  // Initialize email
$form['age']   = '';                                                  // Initialize age

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                           // If submitted
    $filters['email']                       = FILTER_VALIDATE_EMAIL;  // Email filter
    $filters['age']['filter']               = FILTER_VALIDATE_INT;    // Integer filter
    $filters['age']['options']['min_range'] = 16;                     // Min value 16
    $form = filter_input_array(INPUT_POST, $filters);                 // Validate data
}
?>
<?php include 'includes/header.php'; ?>

<form action="validate-multiple-inputs.php" method="POST">
  Email: <input type="text" name="email" value="<?= htmlspecialchars($form['email']) ?>"><br>
  Age: <input type="text" name="age" value="<?= htmlspecialchars($form['age']) ?>"><br>
  I agree to the terms and conditions: <input type="checkbox" name="terms" value="1"><br>
  <input type="submit" value="Save">
</form>
<pre><?php var_dump($form); ?></pre>

<?php include 'includes/footer.php'; ?>