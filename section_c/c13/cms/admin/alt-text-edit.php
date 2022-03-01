<?php
declare(strict_types = 1);                                // Use strict types
include '../includes/database-connection.php';            // Database connection
include '../includes/functions.php';                      // Functions
include '../includes/validate.php';                       // Validation functions

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Get and validate id

$image = [
    'file' => '',
    'alt' => '',
];                                                        // Initialize image array
$errors = [
    'alt' => '',
    'warning' => '',
];                                                        // Initialize error message

if ($id) {                                                // If valid article id
    $sql = "SELECT i.id, i.file, i.alt 
            FROM image   AS i
            JOIN article AS a
              ON i.id = a.image_id
           WHERE a.id = :id;";                            // SQL to get image data
    $image = pdo($pdo, $sql, [$id])->fetch();             // Get image data
}
if (!$image) {                                            // If no image
    redirect('article.php', ['id' => $id]);               // Redirect
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {               // If form was submitted
    $image['alt'] = $_POST['image_alt'];                  // Get alt text

    $errors['alt'] = (is_text($image['alt'], 1, 254))
        ? '' : 'Alt text for image should be 1 - 254 characters.'; // Validate alt text

    if ($errors['alt']) {                                   // If alt text not long enough
        $errors['warning'] = 'Please correct error below';  // Store error message
    } else {                                                // Otherwise
        unset($image['file']);                              // Remove file from $image array
        $sql = "UPDATE image 
                   SET alt = :alt 
                 WHERE id = :id;";                          // SQL to update image table
        pdo($pdo, $sql, $image);                            // Update alt text
        redirect('article.php', ['id' => $id]);             // Send back to article page
    }
}
?>
<?php include '../includes/admin-header.php'; ?>
  <main class="container admin" id="content">
    <form action="alt-text-edit.php?id=<?= $id ?>" method="POST" class="narrow">
      <h1>Update Alt Text</h1>
      <?php if ($errors['warning']) { ?><div class="alert alert-danger"><?= $errors['warning'] ?></div><?php } ?>

      <div class="form-group">
        <label for="image_alt">Alt text: </label>
        <input type="text" name="image_alt" id="image_alt" value="<?= html_escape($image['alt']) ?>"  class="form-control">
        <span class="errors"><?= $errors['alt'] ?></span>
      </div>

      <div class="form-group">
        <input type="submit" name="delete" value="Confirm" class="btn btn-primary btn-save">
      </div>

      <img src="../uploads/<?= $image['file'] ?>" alt="<?= html_escape($image['alt']) ?>">
    </form>
  </main>
<?php include '../includes/admin-footer.php'; ?>