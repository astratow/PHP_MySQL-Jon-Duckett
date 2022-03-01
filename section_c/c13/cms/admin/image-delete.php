<?php
declare(strict_types = 1);                                // Use strict types
include '../includes/database-connection.php';            // Database connection
include '../includes/functions.php';                      // Functions

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Get and validate id
$image = [];                                              // Initialize image array

if ($id) {                                                // If valid id+form not sent
    $sql = "SELECT i.id, i.file, i.alt 
              FROM image   AS i
              JOIN article AS a
                ON i.id = a.image_id
             WHERE a.id = :id;";                          // SQL to get image data
    $image = pdo($pdo, $sql, [$id])->fetch();             // Get image data
}
if (!$image) {                                            // If no image
    redirect('article.php', ['id' => $id]);               // Redirect
}

$path = '../uploads/' . $image['file'];                   // Path to file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {               // If form was submitted
    $sql = "UPDATE article SET image_id = null WHERE id = :article_id;"; // SQL to delete image from article table
    pdo($pdo, $sql, [$id]);                               // Delete image from article
    $sql = "DELETE FROM image WHERE id = :id;";           // SQL to delete image from image table
    pdo($pdo, $sql, [$image['id']]);                      // Delete image from image
    if (file_exists($path)) {                             // If image file exists
        $unlink = unlink($path);                          // Delete image file
    }
    redirect('article.php', ['id' => $id]);               // Redirect
}
?>
<?php include '../includes/admin-header.php'; ?>
  <main class="container admin" id="content">
      <form action="image-delete.php?id=<?= $id ?>" method="POST" class="narrow">
        <h1>Delete Image</h1>
        <p><img src="../uploads/<?= html_escape($image['file']) ?>" alt="<?= html_escape($image['alt']) ?>"></p>
        <p>Click confirm to delete the image:</p>
        <input type="submit" name="delete" value="Confirm" class="btn btn-primary" />
        <a href="article.php?id=<?= $id ?>" class="btn btn-danger">Cancel</a>
      </form>
  </main>
<?php include '../includes/admin-footer.php'; ?>