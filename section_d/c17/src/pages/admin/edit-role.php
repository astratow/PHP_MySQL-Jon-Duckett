<?php
is_admin($session->role);                                          // Check if admin
if (!$id) {                                                        // If no id
    redirect('page-not-found/');                                   // Page not found
}

$member = $cms->getMember()->get($id);                             // Get member data
if (!$member) {                                                    // If no member data
    redirect('page-not-found/');                                   // Page not found
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                        // If form submitted
    $role = $_POST['role'] ?? '';                                  // Get new role
    if (in_array($role, ['member', 'admin', 'suspended'])) {       // If valid role will update
        $member['role'] = $role;                                   // Update role in array
        $cms->getMember()->update($member);                        // Update role in database  <<< need to unset joined and member
        redirect('admin/members/', ['success' => 'Role updated']); // Redirect with message
    }
}

$data['member']  = $member;                                        // Member data for template

echo $twig->render('admin/edit-role.html', $data);                 // Render Twig template