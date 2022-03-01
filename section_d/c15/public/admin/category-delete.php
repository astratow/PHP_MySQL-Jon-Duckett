<?php
declare(strict_types = 1);                               // Use strict types
include '../../src/bootstrap.php';                       // Setup file

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Get and validate id
$category = [];                                           // Initialize category array
$deleted   = null;                                        // Did category delete

if (!$id) {                                               // If valid id
    redirect('admin/categories.php', ['failure' => 'Category not found']); // Redirect with error
}

$category = $cms->getCategory()->get($id);                // Get category
if (!$category) {                                         // If valid id
    redirect('admin/categories.php', ['failure' => 'Category not found']); // Redirect with error
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {               // If form was submitted
    if ($id) {                                            // If valid id
        $deleted  = $cms->getCategory()->delete($id);     // Delete category
        if ($deleted  === true) {                         // If it worked
            redirect('admin/categories.php', ['success' => 'Category deleted']); // Redirect with error
        }
        if ($deleted  === false) {                        // If contains articles
            redirect('admin/categories.php', ['failure' => 'Category contains articles that 
            must be moved or deleted before you can delete the category']); // Redirect
        }
    }
}

$data['category'] = $category;                            // Category

echo $twig->render('admin/category-delete.html', $data);  // Render template