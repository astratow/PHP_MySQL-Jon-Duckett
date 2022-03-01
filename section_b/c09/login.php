<?php
include 'includes/sessions.php';

if ($logged_in) {                              // If already logged in
    header('Location: account.php');           // Redirect to account page
    exit;                                      // Stop further code running
}    

if($_SERVER['REQUEST_METHOD'] == 'POST') {     // If form submitted
    $user_email    =  $_POST['email'];         // Email user sent
    $user_password =  $_POST['password'];      // Password user sent

    if ($user_email == $email and $user_password == $password) { // If details correct
        login();                               // Call login function
        header('Location: account.php');       // Redirect to account page
        exit;                                  // Stop further code running
    }
}
?>
<?php include 'includes/header-member.php'; ?>
<h1>Login</h1>
<form method="POST" action="login.php">
  Email: <input type="email" name="email"><br>
  Password: <input type="password" name="password"><br>
  <input type="submit" value="Log In">
</form>
<?php include 'includes/footer.php'; ?>