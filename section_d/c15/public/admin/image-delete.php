<?php
declare(strict_types = 1);                                  // Use strict types
include '../../src/bootstrap.php';                          // Setup file

$id      = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Get and validate id
$article = [];                                              // Initialize article array

if (!$id) {                                                 // If no id
    redirect('/admin/articles.php', ['failure' => 'Article not found']); // Redirect
}

$article = $cms->getArticle()->get($id, false);             // Get article
if (!$article) {                                            // If no image
    redirect('admin/articles.php', ['failure' => 'Article not found']); // Redirect
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                 // If form was submitted
    $path = APP_ROOT . '/public/uploads/' . $article['image_file']; // Path to file
    $cms->getArticle()->imageDelete($article['image_id'], $path, $id); // Delete image
    redirect('admin/article.php', ['id' => $id]);           // Redirect
}

$data['article'] = $article;                                // Article

echo $twig->render('admin/image-delete.html', $data);       // Render template