<?php
include 'classes/ImageHandler.php';                              // Include class
$message = '';                                                   // Initialize variables
$thumb   = '';
$email   = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {                      // If form sent
    $email = $_POST['email'] ?? '';                              // Get user's email
    if ($_FILES['image']['error'] == 0) {                        // If no upload errors
        $file = $_FILES['image']['name'];                        // Get file name
        $temp = $_FILES['image']['tmp_name'];                    // Get temp location

        try {                                                    // Try to resize image
            $image = new ImageHandler($temp, $file);             // Create object
            $thumb = $image->resizeImage(300, 300, 'uploads/');  // Resize image
            $message = '<img src="' . $thumb . '">';             // Save image in $message
        } catch (ImageHandlerException $e) {                     // If ImageHandlerException
            $message = $e->getMessage();                         // Get error message
        } catch (Throwable $e) {                                 // If other reason
            $message = 'We were unable to save your image';      // Generic message
            error_log($e);                                       // Log error
        }
    }  
    // This is where the page could save the email address
    $message = 'Thank you for registering<br>' . $message;       // Add message to confirmation
}
?>
<?php include 'includes/header.php' ?> 
<h1>Join Us</h1>
<?= $message ?>
<?php if (!$message) { ?>
  <form method="POST" action="throwing-exceptions.php" enctype="multipart/form-data">
    Email:   <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br>
    Picture: <input type="file" name="image" id="image"/><br>
    <input type="submit" value="Save">
  </form>
<?php } ?>
<?php include 'includes/footer.php' ?> 