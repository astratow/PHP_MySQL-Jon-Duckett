<?php
declare(strict_types = 1);                               // Use strict types
include '../../src/bootstrap.php';                       // Setup file

$data['article_count']  = $cms->getArticle()->count();   // Get number of articles
$data['category_count'] = $cms->getCategory()->count();  // Get number of categories

echo $twig->render('admin/admin.html', $data);           // Render template