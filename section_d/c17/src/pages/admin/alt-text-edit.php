<?php
use PhpBook\Validate\Validate;                           // Import Validate namespace
is_admin($session->role);                                // Check if admin

$article = [];                                           // Initialize article array
$errors  = [];                                           // Initialize error message

if (!$id) {                                              // If no id
    redirect('/admin/articles/', ['failure' => 'Article not found']); // Redirect
}

$article = $cms->getArticle()->get($id, false);          // Get article
if (!$article) {                                         // If no article
    redirect('/admin/articles/', ['failure' => 'Article not found']); // Redirect
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form was submitted
    $article['image_alt'] = $_POST['image_alt'];         // Get alt text

    $invalid = (Validate::isText($article['image_alt'], 1, 254))
        ? '' : 'Alt text for image should be 1 - 254 characters.';   // Validate alt text

    if ($invalid) {                                      // If not valid
        $warning = 'Please correct error below';         // Create warning message
    } else {
        $cms->getArticle()->altUpdate($article['image_id'], $article['image_alt']); // Update alt text
        redirect('admin/article/' . $id);                // Send back to article page
    }

}
$data['article'] = $article;                             // Article data for template
$data['errors']  = $errors;                              // Error data for template

echo $twig->render('admin/alt-text-edit.html', $data);   // Render Twig template