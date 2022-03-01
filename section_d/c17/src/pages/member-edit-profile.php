<?php
declare(strict_types = 1);                               // Use strict types
use PhpBook\Validate\Validate;                           // Use Validate class

$id = $cms->getSession()->id;                            // Get user's id from session
if ($id === 0) {                                         // If not logged in
    redirect('login/');                                  // Page not found
}

$errors  = [];                                           // Error messages

if ($_SERVER['REQUEST_METHOD'] != 'POST') {              // If form not posted
    $member  = $cms->getMember()->get($cms->getSession()->id); // Get member details
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form was posted
    $member['id']       = $cms->getSession()->id;        // Get member id
    $member['forename'] = $_POST['forename'];            // Get forename
    $member['surname']  = $_POST['surname'];             // Get surname
    $member['email']    = $_POST['email'];               // Get email
    $member['role']     = $cms->getSession()->role;      // Get role

    // Validate form data
    $errors['forename'] = Validate::isText($member['forename'], 1, 254) ? '' :
        'Forename should be between 1 and 254 characters';
    $errors['surname']  = Validate::isText($member['surname'], 1, 254) ? '' :
        'Surname should be between 1 and 254 characters';
    $errors['email']    = Validate::isEmail($member['email']) ? '' :
        'Please enter a valid email address';

    $invalid = implode($errors);                            // Join any error messages
    if ($invalid) {                                         // If validation failed
        $errors['message'] = 'Please correct form errors';  // Store a warning
    } else {                                                // Otherwise
        $result = $cms->getMember()->update($member);       // Create new member & store id
        if ($result === false) {                            // If result is false
            $errors['message'] = 'Email already in use';    // Store a warning
        } else {                                            // Otherwise
            $cms->getSession()->update($member);            // Update session
            redirect('member/' . $member['id'] . '/', ['success'=>'Profile saved',]); // Send to profile page
        }
    }
}

$data['navigation'] = $cms->getCategory()->getAll();     // All categories for nav
$data['member']     = $member;                           // Member data
$data['errors']     = $errors;                           // Error messages

echo $twig->render('member-edit-profile.html', $data);   // Render Twig template