<?php
include 'includes/sessions.php';
require_login($logged_in);                  // Redirect user if not logged in
?>
<?php include 'includes/header-member.php'; // Include new header file ?>

  <h1>Account</h1>
  A user account page goes here.

<?php include 'includes/footer.php'; ?>