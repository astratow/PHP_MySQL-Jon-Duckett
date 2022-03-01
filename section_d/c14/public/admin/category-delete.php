<?php
declare(strict_types=1);                                  // Use strict types
include '../../src/bootstrap.php';                        // Include setup file

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Get and validate id
$category = [];                                           // Initialize category array
$deleted  = null;                                         // Did category delete

if (!$id) {                                               // If valid id
    redirect('admin/categories.php', ['failure' => 'Category not found']); // Redirect with error
}

$category = $cms->getCategory()->get($id);               // Get category
if (!$category) {                                        // If valid id
    redirect('admin/categories.php', ['failure' => 'Category not found']); // Redirect with error
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form was submitted
    if ($id) {                                           // If valid id
        $deleted  = $cms->getCategory()->delete($id);    // Delete category
        if ($deleted  === true) {                        // If it worked
            redirect('admin/categories.php', ['success' => 'Category deleted']); // Redirect with error
        }
        if ($deleted  === false) {                       // If contains articles
            redirect('admin/categories.php', ['failure' => 'Category contains articles that 
            must be moved or deleted before you can delete the category']); // Redirect
        }
    }
}
?>
<?php include APP_ROOT . '/public/includes/admin-header.php'; ?>
  <main class="container admin" id="content">
    <form action="category-delete.php?id=<?= $id ?>" method="POST" class="narrow">
      <h1>Delete Category</h1>
      <p>Click confirm to delete the category: <em><?= html_escape($category['name']) ?></em></p>
      <input type="submit" name="delete" value="Confirm" class="btn btn-primary">
      <a href="categories.php" class="btn btn-danger">Cancel</a>
    </form>
  </main>
<?php include APP_ROOT . '/public/includes/admin-footer.php'; ?>