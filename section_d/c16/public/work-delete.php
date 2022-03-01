<?php
declare(strict_types = 1);                               // Use strict types
include '../src/bootstrap.php';                          // Setup file

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);// Validate id
if (!$id) {                                              // If no valid id
    include APP_ROOT . '/public/page-not-found.php';     // Page not found
}
$article = $cms->getArticle()->get($id, false);          // Get article data
if (!$article) {                                         // If $article empty
    include APP_ROOT . '/public/page-not-found.php';     // Page not found
}
if ($article['member_id'] !== $cms->getSession()->id) {  // If not by this member
    include APP_ROOT . '/public/page-not-found.php';     // Page not found
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form was submitted
    if (isset($article['image_id'])) {                   // If there was an image
        $path = APP_ROOT . '/public/uploads/' . $article['image_file'];  // Set the image path
        $cms->getArticle()->imageDelete($article['image_id'], $path, $article['id']); // Delete image
    }
    $cms->getArticle()->delete($id);                     // Delete article
    redirect('member.php', ['id'=>$cms->getSession()->id, 'success'=>'Article deleted',]); // Send to profile page
}

$data['navigation'] = $cms->getCategory()->getAll();     // All categories for navigation
$data['article']    = $article;                          // Data for Twig template

echo $twig->render('work-delete.html', $data);           // Render template