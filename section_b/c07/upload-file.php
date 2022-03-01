<?php 
$message = '';                                                            // Initialize
if ($_SERVER['REQUEST_METHOD'] == 'POST') {                               // If form sent
   if ($_FILES['image']['error'] === 0) {                                 // If no errors
       $message  = '<b>File:</b> ' . $_FILES['image']['name'] . '<br>';   // File name
       $message .= '<b>Size:</b> ' . $_FILES['image']['size'] . ' bytes'; // File size
   } else {                                                               // Otherwise
       $message  = 'The file could not be uploaded.';                     // Error message
   }
}
?>
<?php include 'includes/header.php' ?>

<?= $message ?>
<form method="POST" action="upload-file.php" enctype="multipart/form-data">
  <label for="image"><b>Upload file:</b></label>
  <input type="file" name="image" accept="image/*" id="image"><br>
  <input type="submit" value="Upload">
</form>

<?php include 'includes/footer.php' ?>