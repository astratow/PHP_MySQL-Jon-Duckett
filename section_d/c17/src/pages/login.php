<?php
declare(strict_types = 1);                               // Use strict types
use PhpBook\Validate\Validate;                           // Import Validate class

if ($cms->getSession()->role !== 'public') {             // If user is already logged in
    redirect('member/' . $cms->getSession()->id);        // Redirect to their page
    exit;                                                // Stop code running
}

$email   = '';                                           // Initialize email variable
$errors  = [];                                           // Initialize errors
$success = $_GET['success'] ?? null;                     // Get success message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {              // If form submitted
    $email    = $_POST['email'];                         // Get email address
    $password = $_POST['password'];                      // Get password

    $errors['email']    = Validate::isEmail($email)
        ? '' : 'Please enter a valid email address';           // Validate email
    $errors['password'] = Validate::isPassword($password)
        ? '' : 'Passwords must be at least 8 characters and have:<br> 
                A lowercase letter<br>An uppercase letter<br>A number 
                <br>And a special character';                  // Validate password
    $invalid = implode($errors);                               // Join errors

    if ($invalid) {                                            // If data is not valid
        $errors['message'] = 'Please try again.';              // Store error message
    } else {                                                   // If data was valid
        $member = $cms->getMember()->login($email, $password); // Get member details
        if ($member and $member['role'] == 'suspended') {      // If member is suspended
            $errors['message'] = 'Account suspended';          // Store message
        } elseif ($member) {                                   // Otherwise for members
            $cms->getSession()->create($member);               // Create session
            redirect('member/' . $member['id']);               // Redirect to their page
        } else {                                               // Otherwise
            $errors['message'] = 'Please try again.';          // Store error message
        }
    }
}

$data['navigation'] = $cms->getCategory()->getAll();     // Get navigation categories
$data['success']    = $success;                          // Success message
$data['email']      = $email;                            // Email address if validation failed
$data['errors']     = $errors;                           // Errors array

echo $twig->render('login.html', $data);                 // Render Twig template