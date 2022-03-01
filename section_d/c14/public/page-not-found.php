<?php 
declare(strict_types = 1);                               // Use strict types
http_response_code(404);                                 // Set HTTP response code
require_once '../src/bootstrap.php';                     // Setup file

$navigation  = $cms->getCategory()->getAll();            // Get categories
$section     = '';                                       // Current category
$title       = 'Page not found';                         // HTML <title> content
$description = 'Page not found';                         // Meta description content
?>
<?php include APP_ROOT . '/public/includes/header.php'; ?>
  <main class="container" id="content">
    <h1>Sorry! We cannot find that page.</h1>
    <p>Try the <a href="index.php">home page</a> or email us
      <a href="mailto:hello@eg.link">hello@eg.link</a></p>
  </main>
<?php include APP_ROOT . '/public/includes/footer.php'; ?>
<?php exit ?>