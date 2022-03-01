<?php
// Part A: Setup
declare(strict_types=1);                                 // Use strict types
include '../../src/bootstrap.php';                       // Include setup file

// Initialize variables that the PHP code needs
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);// Get id and validate
$saved = null;                                           // Did category save

// Initialize variables that are needed for the the HTML page
$category = [
    'id'          => $id,
    'name'        => '',
    'description' => '',
    'navigation'  => false,
];                                                       // Initialize category array
$errors = [
    'warning'     => '',
    'name'        => '',
    'description' => '',
];                                                       // Initialize errors array

if ($id) {                                               // If id and not submitted
    $category = $cms->getCategory()->get($id);           // Get category data
    if (!$category) {                                    // If no category data
        redirect('admin/categories.php', ['failure' => 'Category not found']); // Redirect with error
    }
}

// PART B: Get and validate form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form submitted
    $category['name']        = $_POST['name'];           // Get name
    $category['description'] = $_POST['description'];    // Get description
    $category['navigation']  = isset($_POST['navigation']) ? 1 : 0; // Get navigation

    $errors['name']          = (Validate::isText($category['name'], 1, 24))
        ? '' : 'Name should be 1-24 characters.';        // Validate name
    $errors['description']   = (Validate::isText($category['description'], 1, 254))
        ? '' : 'Description should be 1-254 characters.';// Validate description
    $invalid = implode($errors);                         // Join error messages

    // PART C: Check if data is valid, if so update database
    if ($invalid) {                                        // If data is invalid
        $errors['warning'] = 'Please correct errors';      // Error message
    } else {                                               // Otherwise create / update
        $arguments = $category;                            // Set parameters array for SQL
        if ($id) {                                         // If have id
            $saved = $cms->getCategory()->update($arguments); // Try to update category
        } else {                                           // If no id
            unset($arguments['id']);                       // Remove id from array
            $saved = $cms->getCategory()->create($arguments); // Try to create category
        }
        if ($saved === true) {                            // If succeeded
            redirect('admin/categories.php', ['success' => 'Category saved']); // Redirect
        }
        if ($saved === false) {                           // If duplicate category
            $errors['warning'] = 'Category name already in use'; // Store error message
        }
    }
}
?>
<?php include APP_ROOT . '/public/includes/admin-header.php'; ?>
  <main class="container admin" id="content">
    <form action="category.php?id=<?= $id ?>" method="post" class="narrow">
      <h1>Edit Category</h1>
      <?php if ($errors['warning']) { ?>
        <div class="alert alert-danger"><?= $errors['warning'] ?></div>
      <?php } ?>

      <div class="form-group">
        <label for="name">Name: </label>
        <input type="text" name="name" id="name"
               value="<?= html_escape($category['name']) ?>" class="form-control">
        <span class="errors"><?= $errors['name'] ?></span>
      </div>

      <div class="form-group">
        <label for="description">Description: </label>
        <textarea name="description" id="description"
                  class="form-control"><?= html_escape($category['description']) ?></textarea>
        <span class="errors"><?= $errors['description'] ?></span>
      </div>

      <div class="form-check">
        <input type="checkbox" name="navigation" id="navigation"
               value="1" class="form-check-input"
          <?= ($category['navigation'] === 1) ? 'checked' : '' ?>>
        <label class="form-check-label" for="navigation">Navigation</label>
      </div>

      <input type="submit" value="Save" class="btn btn-primary btn-save">
    </form>
  </main>
<?php include APP_ROOT . '/public/includes/admin-footer.php'; ?>