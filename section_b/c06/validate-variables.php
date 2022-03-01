<?php
$form['email'] = '';                                                   // Initialize
$form['age']   = '';
$form['terms'] = 0;
$data          = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {                            // If submitted
    $filters['email']                       = FILTER_VALIDATE_EMAIL;   // Email filter
    $filters['age']['filter']               = FILTER_VALIDATE_INT;     // Integer filter
    $filters['age']['options']['min_range'] = 16;                      // Min age
    $filters['terms']                       = FILTER_VALIDATE_BOOLEAN; // Boolean filter
    $form = filter_input_array(INPUT_POST);                            // Get all values
    $data = filter_var_array($form, $filters);                         // Apply filters
}
?>
<?php include 'includes/header.php'; ?>

<form action="validate-variables.php" method="POST">
  Email: <input type="text" name="email" value="<?= htmlspecialchars($form['email']) ?>"><br>
  Age:  <input type="text" name="age" value="<?= htmlspecialchars($form['age']) ?>"><br>
  I agree to the terms and conditions: <input type="checkbox" name="terms" value="1"><br>
  <input type="submit" value="Save">
</form>

<pre><?php var_dump($data); ?></pre>

<?php include 'includes/footer.php'; ?>