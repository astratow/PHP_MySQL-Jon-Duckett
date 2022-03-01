<?php
is_admin($session->role);                                // Check if admin
$data['success'] = $_GET['success'] ?? null;             // Store message if one exists
$data['failure'] = $_GET['failure'] ?? null;             // Store message if one exists
$data['members'] = $cms->getMember()->getAll();          // Member data for template
echo $twig->render('admin/members.html', $data);         // Render Twig template