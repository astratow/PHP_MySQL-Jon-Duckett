<?php
declare(strict_types = 1);                                      // Use strict types
use PhpBook\Validate\Validate;                                  // Import Validate namespace
include '../src/bootstrap.php';                                 // Setup file

$error = false;                                                 // Error message
$sent  = false;                                                 // Has email been sent

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                     // If form submitted
    $email = $_POST['email'];                                            // Get email
    $error = Validate::isEmail($email) ? '' : 'Please enter your email'; // Validate
    if ($error === '') {                                                 // If valid
        $id = $cms->getMember()->getIdByEmail($email);                   // Get member id  
        if ($id) {                                                       // If id found
            $token = $cms->getToken()->create($id, 'password_reset');    // Token
            $link  = DOMAIN . DOC_ROOT . 'password-reset.php?token=' . $token; // Link
            $subject = 'Reset Password Link';                            // Subject + body
            $body  = 'To reset password click: <a href="' . $link . '">' . $link . '</a>';
            $mail  = new \PhpBook\Email\Email($email_config);            // Email object 
            $sent  = $mail->sendEmail($email_config['admin_email'], $email, 
               $subject, $body);                                         // Send mail
        }
    }
}

$data['navigation'] = $cms->getCategory()->getAll();         // Categories for navigation
$data['error']      = $error;                                // Validation errors
$data['sent']       = $sent;                                 // Did it send

echo $twig->render('password-lost.html', $data);            // Render template