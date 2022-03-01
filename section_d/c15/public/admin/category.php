<?php
// Part A: Setup
declare(strict_types = 1);                               // Use strict types
use PhpBook\Validate\Validate;                           // Import Validate namespace

include '../../src/bootstrap.php';                       // Setup file

// Initialize variables that the PHP code needs
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);// Get id+validate
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
    $invalid                 = implode($errors);         // Join error messages

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
        if ($saved === true) {                             // If succeeded
            redirect('admin/categories.php', ['success' => 'Category saved']); // Redirect
        }
        if ($saved === false) {                            // If duplicate category
            $errors['warning'] = 'Category name already in use'; // Store error message
        }
    }
}

$data['category'] = $category;                              // Add category to template
$data['errors']   = $errors;                                // Add errors to template

echo $twig->render('admin/category.html', $data);           // Render template