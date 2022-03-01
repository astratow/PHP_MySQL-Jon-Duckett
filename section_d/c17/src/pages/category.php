<?php
declare(strict_types = 1);                                 // Use strict types

if (!$id) {                                                // If no valid id
    include APP_ROOT . '/src/pages/page-not-found.php';    // Page not found
}

$category = $cms->getCategory()->get($id);                 // Get category data
if (!$category) {                                          // If category is empty
    include APP_ROOT . '/src/pages/page-not-found.php';    // Page not found
}

if (mb_strtolower($parts[2]) != mb_strtolower($category['seo_name'])) { // If SEO name wrong
    redirect('category/' . $id . '/' . $category['seo_name'], [], 301); // Redirect to correct URL
}

$data['navigation'] = $cms->getCategory()->getAll();       // Get navigation categories
$data['category']   = $category;                           // Current category
$data['articles']   = $cms->getArticle()->getAll(true, $id); // Get articles
$data['section']    = $category['id'];                     // Category id for nav

echo $twig->render('category.html', $data);                // Render Twig template