<?phps
$color   = $_COOKIE['color'] ?? null;       // Get data
$options = ['light', 'dark',];              // Options

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // If posted
    $color = $_POST['color'];               // Get color
    setcookie('color', $color, time() + 60 * 60,
        '/', '', false, true);              // Set cookie
}

// If color is valid option, use it - otherwise use dark
$scheme = (in_array($color, $options)) ? $color : 'dark';
?>
<?php include 'includes/header-style-switcher.php'; ?> 
  <form method="POST" action="cookie-preferences.php"> 
    Select color scheme:
    <select name="color">
      <option value="dark">Dark</option>
      <option value="light">Light</option>
    </select><br>
    <input type="submit" value="Save">
  </form>
<?php include 'includes/footer.php'; ?>