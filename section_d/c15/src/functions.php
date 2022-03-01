<?php
// UTILITY FUNCTIONS
function redirect(string $location, array $parameters = [], $response_code = 302)
{
    $qs = $parameters ? '?' . http_build_query($parameters) : '';  // Create query string
    $location = $location . $qs;                                   // Create new path
    header('Location: ' . DOC_ROOT . $location, $response_code);   // Redirect to new page
    exit;                                                          // Stop code
}

function create_filename(string $filename, string $uploads): string
{
    $basename  = pathinfo($filename, PATHINFO_FILENAME);          // Get basename
    $extension = pathinfo($filename, PATHINFO_EXTENSION);         // Get extension
    $cleanname = preg_replace("/[^A-z0-9]/", "-", $basename);     // Clean basename
    $filename  = $cleanname . '.' . $extension;                   // Destination
    $i         = 0;                                               // Counter
    while (file_exists($uploads . $filename)) {                   // If file exists
        $i        = $i + 1;                                       // Update counter
        $filename = $basename . $i . '.' . $extension;            // New filename
    }
    return $filename;                                             // Return filename
}

// ERROR AND EXCEPTION HANDLING FUNCTIONS
// Convert errors to exceptions
function handle_error($error_type, $error_message, $error_file, $error_line)
{
    throw new ErrorException($error_message, 0, $error_type, $error_file, $error_line); // Turn into ErrorException
}

// Handle exceptions - log exception and show error message (if server does not send error page listed in .htaccess)
function handle_exception($e)
{
    error_log($e);                        // Log the error
    http_response_code(500);              // Set the http response code
    echo "<h1>Sorry, a problem occurred</h1>   
          The site's owners have been informed. Please try again later.";
}

// Handle fatal errors
function handle_shutdown()
{
    $error = error_get_last();            // Check for error in script
    if ($error !== null) {                // If there was an error next line throws exception
        $e = new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
        handle_exception($e);             // Call exception handler
    }
}