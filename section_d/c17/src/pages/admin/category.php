<?php
// Part A: Setup
use PhpBook\Validate\Validate;                           // Import Validate namespace
is_admin($session->role);                                // Check if admin

// Initialize variables that the PHP code needs
$saved = null;                                           // Did category save

// Initialize variables that are needed for the the HTML page
$category = [];                                          // Initialize category array
$errors   = [];                                          // Initialize errors array

if ($id) {                                               // If id and not submitted
    $category = $cms->getCategory()->get($id);           // Get category data
    if (!$category) {                                    // If no category data
        redirect('/admin/categories/', ['failure' => 'Category not found']); // Redirect with error
    }
}

// PART B: Get and validate form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form submitted
    $category['name']        = $_POST['name'];           // Get name
    $category['description'] = $_POST['description'];    // Get description
    $category['navigation']  = isset($_POST['navigation']) ? 1 : 0; // Get navigation
    $category['seo_name']    = create_seo_name($category['name']);  // SEO-friendly name

    $errors['name']          = (Validate::isText($category['name'], 1, 24))
        ? '' : 'Name should be 1-24 characters.';        // Validate name
    $errors['description']   = (Validate::isText($category['description'], 1, 254))
        ? '' : 'Description should be 1-254 characters.';// Validate description
    $invalid                 = implode($errors);         // Join error messages

    // PART C: Check if data is valid, if so update database
    if ($invalid) {                                          // If data is invalid
        $errors['warning'] = 'Please correct errors';        // Error message
    } else {                                                 // Otherwise create / update
        if ($id) {                                           // If have id
            $saved = $cms->getCategory()->update($category); // Try to update category
        } else {                                             // If no id
            $saved = $cms->getCategory()->create($category); // Try to create category
        }
        if ($saved === true) {                               // If succeeded
            redirect('admin/categories/', ['success' => 'Category saved']); // Redirect
        }
        if ($saved === false) {                              // If duplicate category
            $errors['warning'] = 'Category name already in use'; // Store error message
        }
    }
}

$data['category'] = $category;                              // Add category to template
$data['errors']   = $errors;                                // Add errors to template

echo $twig->render('admin/category.html', $data);           // Render Twig template