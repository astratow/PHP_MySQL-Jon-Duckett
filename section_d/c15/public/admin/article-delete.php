<?php
declare(strict_types = 1);                                    // Use strict types
include '../../src/bootstrap.php';                            // Setup file
$deleted = null;                                              // Did article delete

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);     // Validate id
if (!$id) {                                                   // If no id
    redirect('admin/articles.php', ['failure' => 'Article not found']); // Redirect
}

$article = $cms->getArticle()->get($id, false);               // Get article
if (!$article) {                                              // If no article
    redirect('admin/articles.php', ['failure' => 'Article not found']); // Redirect
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                   // If form was submitted
    if (isset($article['image_id'])) {                        // If there was an image
        $path = APP_ROOT . '/public/uploads/' . $article['image_file']; // Set the image path
        $cms->getArticle()->imageDelete($article['image_id'], $path, $id); // Delete image
    }
    $deleted = $cms->getArticle()->delete($id);               // Delete article
    if ($deleted === true) {                                  // If deleted
        redirect('admin/articles.php', ['success' => 'Article deleted']); // Redirect
    } else {                                                  // Otherwise
        throw new Exception('Unable to delete article');      // Throw an exception
    }
}

$data['article'] = $article;                                  // Article

echo $twig->render('admin/article-delete.html', $data); // Render template