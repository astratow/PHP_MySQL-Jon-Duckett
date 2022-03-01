<?php
$deleted   = null;                                            // Did article delete
is_admin($session->role);                                     // Check if admin

if (!$id) {                                                   // If no id
    redirect('admin/articles/', ['failure' => 'Article not found']); // Redirect
}

$article = $cms->getArticle()->get($id, false);               // Get article
if (!$article) {                                              // If no article
    redirect('admin/articles/', ['failure' => 'Article not found']); // Redirect
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                   // If form was submitted
    if (isset($article['image_id'])) {                        // If there was an image
        $path = APP_ROOT . '/public/uploads/' . $article['image_file']; // Set the image path
        $cms->getArticle()->imageDelete($article['image_id'], $path, $id); // Delete image
    }
    $deleted = $cms->getArticle()->delete($id);               // Delete article
    if ($deleted === true) {                                  // If deleted
        redirect('admin/articles/', ['success' => 'Article deleted']); // Redirect
    } else {                                                  // Otherwise
        throw new Exception('Unable to delete article');      // Throw an exception
    }
}

$data['article'] = $article;                                  // Article data for template

echo $twig->render('admin/article-delete.html', $data);       // Render Twig template