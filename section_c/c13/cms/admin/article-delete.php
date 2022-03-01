<?php
declare(strict_types = 1);                                // Use strict types
include '../includes/database-connection.php';            // Database connection
include '../includes/functions.php';                      // Include functions

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {                                               // If no valid id
    redirect('articles.php', ['failure' => 'Article not found']); // Redirect with error
}

$article = false;                                         // Initialize article
$sql = "SELECT a.title, a.image_id,
               i.file      AS image_file 
          FROM article     AS a
          LEFT JOIN image  AS i  ON a.image_id    = i.id
         WHERE a.id = :id;";                              // SQL to get article data
$article = pdo($pdo, $sql, [$id])->fetch();               // Get article data
if (!$article) {                                          // If $article empty
    redirect('articles.php', ['failure' => 'Article not found']); // Redirect
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {               // If form was submitted
    try {
        $pdo->beginTransaction();                         // Start transaction

        // If there is an image, delete the image first
        if ($article['image_id']) {                         // If there was an image
            $sql = "UPDATE article SET image_id = null WHERE id = :article_id;"; // SQL to update article table
            pdo($pdo, $sql, [$id]);                         // Remove image from article
            $sql = "DELETE FROM image WHERE id = :id;";     // SQL to delete from image table
            pdo($pdo, $sql, [$article['image_id']]);        // Delete from image table
            $path = '../uploads/' . $article['image_file']; // Set the image path
            if (file_exists($path)) {                       // If image file exists
                $unlink = unlink($path);                    // Delete image file
            }
        }

        $sql = "DELETE FROM article WHERE id = :id;";       // SQL to delete article
        pdo($pdo, $sql, [$id]);                             // Delete article
        $pdo->commit();                                     // Commit transaction
        redirect('articles.php', ['success' => 'Article deleted']); // Redirect
    } catch (PDOException $e) {                             // If exception thrown
        $pdo->rollBack();                                   // Roll back SQL changes
        throw $e;                                           // Re-throw exception
    }
}
?>
<?php include '../includes/admin-header.php'; ?>
  <main class="container admin" id="content">
    <form action="article-delete.php?id=<?= $id ?>" method="POST" class="narrow">
      <h1>Delete Article</h1>
      <p>Click confirm to delete the article: <em><?= html_escape($article['title']) ?></em></p>
      <input type="submit" name="delete" value="Confirm" class="btn btn-primary">
      <a href="articles.php" class="btn btn-danger">Cancel</a>
    </form>
  </main>
<?php include '../includes/admin-footer.php'; ?>