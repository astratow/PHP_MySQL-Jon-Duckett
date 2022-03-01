<?php
declare(strict_types = 1);                                         // Use strict types
include '../../src/bootstrap.php';                                 // Include setup file
is_admin($session->role);                                          // Check if admin

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);          // Check id is integer
if (!$id) {                                                        // If no id
    redirect('admin/members.php', ['failure' => 'Member not found']); // Redirect with error
}

$member = $cms->getMember()->get($id);                             // Get member data
if (!$member) {                                                    // If no member data
    redirect('admin/members.php', ['failure' => 'Member not found']); // Redirect with error
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                        // If form submitted
    $role = $_POST['role'] ?? '';                                  // Get new role
    if (in_array($role, ['member', 'admin', 'suspended'])) {       // If valid role will update
        $member['role'] = $role;                                   // Update role in array
        $cms->getMember()->update($member);                        // Update role in database  <<< need to unset joined and member
        redirect('admin/members.php', ['success' => 'Role updated']); // Redirect with message
    }
}

$data['member']  = $member;                                       // Data for template

echo $twig->render('admin/edit-role.html', $data);          // Render template