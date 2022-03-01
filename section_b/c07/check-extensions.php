<?php include 'includes/header.php' ?>

<p><b>GD installed: </b>
<?= (extension_loaded('gd') and function_exists('gd_info')) ? 'Yes' : 'No'; ?></p>

<p><b>ImageMagick installed: </b>
<?= (extension_loaded('imagick') and class_exists('Imagick')) ? 'Yes' : 'No'; ?></p>

<?php include 'includes/footer.php' ?>