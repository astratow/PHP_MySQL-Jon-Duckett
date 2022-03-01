<?php http_response_code(404); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Page not found</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
  </head>
  <body>
    <div class="article">
      <h1>Sorry! We cannot find that page.</h1>
      <p>Try the <a href="home.php">home page</a> or email us 
      <a href="mailto:hello@eg.link">hello@eg.link</a></p>
    </div>
  </body>
</html>
<?php exit; ?>