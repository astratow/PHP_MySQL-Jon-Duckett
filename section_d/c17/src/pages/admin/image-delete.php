<?php
is_admin($session->role);                                   // Check if admin
$article = [];                                              // Initialize article array
if (!$id) {                                                 // If no id
    redirect('admin/articles/', ['failure' => 'Article not found']); // Redirect
}

$article = $cms->getArticle()->get($id, false);             // Get article
if (!$article) {                                            // If no image
    redirect('admin/articles/', ['failure' => 'Article not found']); // Redirect
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                 // If form was submitted
    $path = APP_ROOT . '/public/uploads/' . $article['image_file']; // Path to file
    $cms->getArticle()->imageDelete($article['image_id'], $path, $id); // Delete image
    redirect('admin/article/' . $id);                       // Redirect
}

$data['article'] = $article;                                // Article data for template
echo $twig->render('admin/image-delete.html', $data);       // Render Twig template