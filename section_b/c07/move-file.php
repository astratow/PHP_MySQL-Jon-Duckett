<?php
$message = '';                             // Initialize
$moved   = false;                          // Initialize

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // If sent +
    if ($_FILES['image']['error'] === 0) {  // No errors
        // Store temporary path and new destination
        $temp = $_FILES['image']['tmp_name'];
        $path = 'uploads/' . $_FILES['image']['name'];
        // Move the file and store result in $moved
        $moved = move_uploaded_file($temp, $path);
    }

    if ($moved === true) { // If move worked, show image
        $message = '<img src="' . $path . '">';
    } else {               // Else store error message
        $message = 'The file could not be saved.';
    }
}
?>
<?php include 'includes/header.php' ?>
<?= $message ?>
<form method="POST" action="move-file.php" enctype="multipart/form-data">
  <label for="image"><b>Upload file:</b></label>
  <input type="file" name="image" accept="image/*" id="image"><br>
  <input type="submit" value="upload">
</form>
<?php include 'includes/footer.php' ?>