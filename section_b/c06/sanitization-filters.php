<?php
$user['name']  = 'Ivy<script src="js/bad.js"></script>';      // User's name
$user['age']   = 23.75;                                       // User's age
$user['email'] = '£ivy@eg.link/';                             // User's email

$sanitize_user['name']  = FILTER_SANITIZE_FULL_SPECIAL_CHARS; // HTML Escape filter
$sanitize_user['age']   = FILTER_SANITIZE_NUMBER_INT;         // Integer filter
$sanitize_user['email'] = FILTER_SANITIZE_EMAIL;              // Email filter

$user = filter_var_array($user, $sanitize_user);              // Sanitize output
?>
<?php include 'includes/header.php'; ?>

<p>Name:  <?= $user['name'] ?></p>
<p>Age:   <?= $user['age'] ?></p>
<p>Email: <?= $user['email'] ?></p>
<pre><?php var_dump($user); ?></pre>

<?php include 'includes/footer.php'; ?>