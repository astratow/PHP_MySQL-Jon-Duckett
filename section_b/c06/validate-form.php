<?php
declare(strict_types = 1);                                    // Enable strict tpes
require 'includes/validate.php';                              // Validation functions

$user = [
    'name'  => '',
    'age'   => '',
    'terms' => '',
];                                                            // Initialize $user array

$errors = [
    'name'  => '',
    'age'   => '',
    'terms' => '',
];                                                            // Initialize errors array
$message = '';                                                // Initialize message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                   // If form submitted
    $user['name']  = $_POST['name'];                          // Get name
    $user['age']   = $_POST['age'];                           // Get age then check T&Cs
    $user['terms'] = (isset($_POST['terms']) and $_POST['terms'] == true) ? true : false;

    $errors['name']  = is_text($user['name'], 2, 20)   ? '' : 'Must be 2-20 characters';
    $errors['age']   = is_number($user['age'], 16, 65) ? '' : 'You must be 16-65';
    $errors['terms'] = $user['terms']                  ? '' : 'You must agree to the terms
        and conditions';                                      // Validate data

    $invalid = implode($errors);                              // Join error messages
    if ($invalid) {                                           // If there are errors
        $message = 'Please correct the following errors:';    // Do not process
    } else {                                                  // Otherwise
        $message = 'Your data was valid';                     // Can process data
    }
}
?>
<?php include 'includes/header.php'; ?>

<?= $message ?>
<form action="validate-form.php" method="POST">
  Name: <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>">
  <span class="error"><?= $errors['name'] ?></span><br>
  Age:  <input type="text" name="age" value="<?= htmlspecialchars($user['age']) ?>">
  <span class="error"><?= $errors['age'] ?></span><br>
  <input type="checkbox" name="terms" value="true" <?= $user['terms'] ? 'checked' : '' ?>>
  I agree to the terms and conditions
  <span class="error"><?= $errors['terms'] ?></span><br>
  <input type="submit" value="Save">
</form>

<?php include 'includes/footer.php'; ?>