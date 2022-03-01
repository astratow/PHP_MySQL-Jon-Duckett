<?php
$visited = $_COOKIE['visited'] ?? false; // Get data
if ($visited) {                          // If visited
    $greeting = 'Hello again!';          // Returning
} else {                                 // Otherwise
    $greeting = 'Welcome!';              // New visitor
    setcookie('visited', true);          // Set cookie
}
?>
<?php include 'includes/header.php'; ?> 

<h1><?= $greeting ?></h1>

<?php include 'includes/footer.php'; ?> 