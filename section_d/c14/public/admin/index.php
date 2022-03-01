<?php
declare(strict_types=1);                                 // Use strict types
include '../../src/bootstrap.php';                       // Include setup file

$article_count  = $cms->getArticle()->count();           // Get number of articles
$category_count = $cms->getCategory()->count();          // Get number of categories
?>
<?php include APP_ROOT . '/public/includes/admin-header.php'; ?>
  <main class="container" id="content">
    <section class="header">
      <h1>Admin</h1>
    </section>
    <table class="admin">
      <tr><th></th><th>Count</th><th class="create">Create</th><th class="view">View</th></tr>
        <tr><td><strong>Categories</strong></td><td><?= $category_count ?></td><td><a href="category.php" class="btn btn-primary">Add</a></td><td><a href="categories.php" class="btn btn-primary">View</a></td></tr>
      <tr><td><strong>Articles</strong></td><td><?= $article_count?></td><td><a href="article.php" class="btn btn-primary">Add</a></td><td><a href="articles.php" class="btn btn-primary">View</a></td></tr>
    </table>
  </main>
<?php include APP_ROOT . '/public/includes/admin-footer.php'; ?>