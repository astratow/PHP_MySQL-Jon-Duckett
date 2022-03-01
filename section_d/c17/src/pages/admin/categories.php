<?php
is_admin($session->role);                                // Check if admin
$data['success']    = $_GET['success'] ?? null;          // Check for success message
$data['failure']    = $_GET['failure'] ?? null;          // Check for failure message
$data['categories'] = $cms->getCategory()->getAll();     // Category data for template

echo $twig->render('admin/categories.html', $data);      // Render Twig template