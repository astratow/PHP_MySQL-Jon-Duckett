<?php
declare(strict_types=1);                                 // Use strict types
include '../../src/bootstrap.php';                       // Include setup file
$deleted = null;                                         // Did article delete

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);// Validate id
if (!$id) {                                              // If no id
    redirect('admin/articles.php', ['failure' => 'Article not found']); // Redirect
}

$article = $cms->getArticle()->get($id, false);          // Get article
if (!$article) {                                         // If no article
    redirect('admin/articles.php', ['failure' => 'Article not found']); // Redirect
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form was submitted
    if (isset($article['image_id'])) {                   // If there was an image
        $path = APP_ROOT . '/public/uploads/' . $article['image_file']; // Set the image path
        $cms->getArticle()->imageDelete($article['image_id'], $path, $id); // Delete image
    }
    $deleted = $cms->getArticle()->delete($id);          // Delete article
    if ($deleted === true) {                             // If deleted
        redirect('admin/articles.php', ['success' => 'Article deleted']); // Redirect
    } else {                                             // Otherwise
        throw new Exception('Unable to delete article'); // Throw an exception
    }
}
?>
<?php include APP_ROOT . '/public/includes/admin-header.php'; ?>
  <main class="container admin" id="content">
    <form action="article-delete.php?id=<?= $id ?>" method="POST" class="narrow">
      <h1>Delete Article</h1>
      <p>Click confirm to delete the article: <em><?= html_escape($article['title']) ?></em></p>
      <input type="submit" name="delete" value="Confirm" class="btn btn-primary">
      <a href="articles.php" class="btn btn-danger">Cancel</a>
    </form>
  </main>
<?php include APP_ROOT . '/public/includes/admin-footer.php'; ?>