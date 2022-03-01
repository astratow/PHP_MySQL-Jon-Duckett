<?php
declare(strict_types = 1);                                  // Use strict types
use PhpBook\Validate\Validate;                              // Import Validate class

$error = false;                                             // Error message
$sent  = false;                                             // Has email been sent

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                 // If form submitted
    $email = $_POST['email'];                               // Get email
    $error = Validate::isEmail($email) ? '' : 'Please enter your email'; // Validate
    if ($error === '') {                                    // If email valid
        $id = $cms->getMember()->getIdByEmail($email);      // Get member id
        if ($id) {                                          // If id found
            $token   = $cms->getToken()->create($id, 'password_reset');     // Token
            $link  = DOMAIN . DOC_ROOT . 'password-reset/?token=' . $token; // Link
            $subject = 'Reset Password Link';               // Email subject
            $body    = 'To reset password click: <a href="' . $link . '">' . $link . '</a>'; // Email body
            $mail    = new \PhpBook\Email\Email($email_config);   // Email object
            $mail->sendEmail($email_config['admin_email'], $email, $subject, $body);         // Send
        }                                                                                    // Send to login
    }
}

$data['navigation'] = $cms->getCategory()->getAll();        // Categories for navigation
$data['error']      = $error ?? null;                       // Validation errors
$data['sent']       = $sent;                                 // Did it send

echo $twig->render('password-lost.html', $data);            // Render Twig template