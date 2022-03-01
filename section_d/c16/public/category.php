<?php
declare(strict_types = 1);                                 // Use strict types
include '../src/bootstrap.php';                            // Setup file

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);  // Validate id
if (!$id) {                                                // If no valid id
    include APP_ROOT . '/public/page-not-found.php';       // Page not found
}

$category = $cms->getCategory()->get($id);                 // Get category data
if (!$category) {                                          // If category is empty
    include APP_ROOT . '/public/page-not-found.php';       // Page not found
}

$data['navigation'] = $cms->getCategory()->getAll();       // Get navigation categories
$data['category']   = $category;                           // Current category
$data['articles']   = $cms->getArticle()->getAll(true, $id); // Get articles
$data['section']    = $category['id'];                     // Category id for nav

echo $twig->render('category.html', $data);                // Render template