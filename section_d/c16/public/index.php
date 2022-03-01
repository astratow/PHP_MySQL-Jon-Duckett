<?php
declare(strict_types = 1);                                       // Use strict types
include '../src/bootstrap.php';                                  // Setup file

$data['articles']    = $cms->getArticle()->getAll(true, null, null, 6); // Get latest article summaries
$data['navigation']  = $cms->getCategory()->getAll();            // Get categories

echo $twig->render('index.html', $data);                         // Render template