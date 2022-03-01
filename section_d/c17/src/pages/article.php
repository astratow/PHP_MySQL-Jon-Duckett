<?php
declare(strict_types = 1);                               // Use strict types
use PhpBook\Validate\Validate;                           // Import Validate namespace

if (!$id) {                                              // If no valid id
    include APP_ROOT . '/src/pages/page-not-found.php';  // Page not found
}

$article = $cms->getArticle()->get($id);                 // Get article data
if (!$article) {                                         // If article array is empty
    include APP_ROOT . '/src/pages/page-not-found.php';  // Page not found
}

if (mb_strtolower($parts[2]) != mb_strtolower($article['seo_title'])) { // If SEO title wrong
    redirect('article/' . $id . '/' . $article['seo_title'], [], 301); // Redirect to correct URL
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                   // If form submitted
    $comment = $_POST['comment'];                             // Get comment
    $purifier = new HTMLPurifier();                           // Create HTMLPurifier object
    $purifier->config->set('HTML.Allowed', 'br,b,i,a[href]'); // Set permitted tags
    $comment  = $purifier->purify($comment);                  // Purify comment

    $error    = Validate::isText($comment, 1, 2000)
        ? '' : 'Your comment must be between 1 and 2000 characters.
                It can contain <b>, <i>, <a>, and <br> tags.'; // Validate comment

    if ($error === '') {                                      // If no error, save
        $arguments = [$comment, $article['id'], $cms->getSession()->id,]; // Arguments
        $cms->getComment()->create($arguments);               // Create comment
        redirect($path);                                      // Reload page
    }
}

$data['navigation']  = $cms->getCategory()->getAll();         // Get categories
$data['article']     = $article;                              // Article
$data['section']     = $article['category_id'];               // Current category
$data['comments']    = $cms->getComment()->getAll($id);       // Get comments

if ($cms->getSession()->id > 0) {                             // If user logged in
    $data['liked']    = $cms->getLike()->get([$id, $cms->getSession()->id],); // Did user like?
    $data['error']    = $error ?? null;                       // Comment error
}

echo $twig->render('article.html', $data);                    // Render Twig template