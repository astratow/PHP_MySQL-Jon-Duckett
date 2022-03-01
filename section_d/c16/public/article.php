<?php
declare(strict_types = 1);                                // Use strict types
include '../src/bootstrap.php';                           // Setup file

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {                                               // If no valid id
    include APP_ROOT . '/public/page-not-found.php';      // Page not found
}

$article = $cms->getArticle()->get($id);                  // Get article data
if (!$article) {                                          // If article array is empty
    include APP_ROOT . '/public/page-not-found.php';      // Page not found
}

$data['navigation']  = $cms->getCategory()->getAll();     // Get categories
$data['article']     = $article;                          // Article
$data['section']     = $article['category_id'];           // Current category

echo $twig->render('article.html', $data);                // Render template