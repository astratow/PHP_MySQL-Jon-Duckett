<?php
declare(strict_types = 1);                               // Use strict types
http_response_code(404);                                 // Set HTTP response code
require_once '../src/bootstrap.php';                     // Setup file

$data['navigation']  = $cms->getCategory()->getAll();    // Get categories

echo $twig->render('page-not-found.html', $data);        // Render template
exit;