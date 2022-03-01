<?php
session_start();             // Create/resume session
$visited = $_SESSION['visited'] ?? null;  // Get data
if ($visited) {                           // If visited
    $greeting = 'Hello again!';           // Returning user
} else {                                  // Otherwise
    $greeting = 'Welcome!';               // New visitor 
    $_SESSION['visited'] = true;          // Store data
}
?>
<?php include 'includes/header.php'; ?> 

<h1><?= $greeting ?></h1>

<?php include 'includes/footer.php'; ?> 