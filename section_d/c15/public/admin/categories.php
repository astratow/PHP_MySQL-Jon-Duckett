<?php
declare(strict_types = 1);                                // Use strict types
include '../../src/bootstrap.php';                        // Setup file

$data['success']    = $_GET['success'] ?? null;           // Check for success message
$data['failure']    = $_GET['failure'] ?? null;           // Check for failure message
$data['categories'] = $cms->getCategory()->getAll();      // Get all categories

echo $twig->render('admin/categories.html', $data);       // Render template