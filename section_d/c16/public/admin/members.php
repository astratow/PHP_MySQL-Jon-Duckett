<?php
declare(strict_types = 1);                                // Use strict types
include '../../src/bootstrap.php';                        // Include setup file
is_admin($session->role);                                 // Check if admin

$data['success'] = $_GET['success'] ?? null;              // Store message if one exists
$data['failure'] = $_GET['failure'] ?? null;              // Check for failure message
$data['members'] = $cms->getMember()->getAll();           // Get all members

echo $twig->render('admin/members.html', $data);    // Render template