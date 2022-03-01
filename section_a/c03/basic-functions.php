<?php
function write_logo()
{
    echo '<img src="img/logo.png" alt="Logo">';
}

function write_copyright_notice()
{
    $year = date('Y');
    echo '&copy; ' . $year;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Basic Functions</title>
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
    <header>
      <h1><?php write_logo() ?> The Candy Store</h1>
    </header>
    <article>
      <h2>Welcome to the Candy Store</h2>
    </article>
    <footer>
      <?php write_logo() ?>
      <?php write_copyright_notice() ?>
    </footer>
  </body>
</html>