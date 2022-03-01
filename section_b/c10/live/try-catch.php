<?php include 'includes/header.php'; ?> 

<?php
try {
    include 'includes/ad-server.php';
} catch (Throwable $e) {
    echo '<img src="img/newsletter.png" alt="Newsletter">';
    error_log($e);
}
?> 
<h1>Latest Products</h1>

<?php include 'includes/footer.php'; ?> 