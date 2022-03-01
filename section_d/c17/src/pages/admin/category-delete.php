<?php
is_admin($session->role);                                 // Check if admin
$category = [];                                           // Initialize category array
$deleted   = null;                                        // Did category delete

if (!$id) {                                               // If valid id
    redirect('admin/categories/', ['failure' => 'Category not found']); // Redirect with error
}

$category = $cms->getCategory()->get($id);                // Get category
if (!$category) {                                         // If valid id
    redirect('admin/categories/', ['failure' => 'Category not found']); // Redirect with error
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {               // If form was submitted
    if ($id) {                                            // If valid id
        $deleted  = $cms->getCategory()->delete($id);     // Delete category
        if ($deleted  === true) {                         // If it worked
            redirect('admin/categories/', ['success' => 'Category deleted']); // Redirect with error
        }
        if ($deleted  === false) {                        // If contains articles
            redirect('admin/categories/', ['failure' => 'Category contains articles that 
            must be moved or deleted before you can delete the category']); // Redirect
        }
    }
}

$data['category'] = $category;                            // Category data for template
echo $twig->render('admin/category-delete.html', $data);  // Render Twig template