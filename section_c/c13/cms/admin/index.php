<?php
declare(strict_types = 1);                                // Use strict types
require '../includes/database-connection.php';            // Database connection
require '../includes/functions.php';                      // Functions

$sql = "SELECT count(id) FROM article";                   // SQL
$article_count = pdo($pdo, $sql)->fetchColumn();          // Get number of articles
$sql = "SELECT count(id) FROM category";                  // SQL
$category_count = pdo($pdo, $sql)->fetchColumn();         // Get number of categories
?>
<?php include '../includes/admin-header.php'; ?>
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
<?php include  '../includes/admin-footer.php'; ?>