<?php
declare(strict_types = 1);                               // Use strict types
include '../../src/bootstrap.php';                       // Include setup file
is_admin($session->role);                                // Check if admin

$data['success']  = $_GET['success'] ?? null;            // Check for success message
$data['failure']  = $_GET['failure'] ?? null;            // Check for failure message
$data['articles'] = $cms->getArticle()->getAll(0);       // Get article summaries

echo $twig->render('admin/articles.html', $data);  // Render template