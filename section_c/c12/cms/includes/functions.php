<?php
// DATABASE FUNCTION
function pdo(PDO $pdo, string $sql, array $arguments = null)
{
    if (!$arguments) {                   // If no arguments
        return $pdo->query($sql);        // Run SQL and return PDOStatement object
    }
    $statement = $pdo->prepare($sql);    // If arguments prepare statement
    $statement->execute($arguments);     // Execute statement
    return $statement;                   // Return PDOStatement object
}

// FORMATTING FUNCTIONS
function html_escape($text): string
{
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8', false); // Return escaped string
}

function format_date(string $string): string
{
    $date = date_create_from_format('Y-m-d H:i:s', $string);    // Convert to DateTime object
    return $date->format('F d, Y');                             // Return in format Jan 31, 2030
}

// ERROR AND EXCEPTION HANDLING FUNCTIONS
// Convert errors to exceptions
set_error_handler('handle_error');
function handle_error($error_type, $error_message, $error_file, $error_line)
{
    throw new ErrorException($error_message, 0, $error_type, $error_file, $error_line); // Turn into ErrorException
}

// Handle exceptions - log exception and show error message (if server does not send error page listed in .htaccess)
set_exception_handler('handle_exception');
function handle_exception($e)
{
    error_log($e);                        // Log the error
    http_response_code(500);              // Set the http response code
    echo "<h1>Sorry, a problem occurred</h1>   
          The site's owners have been informed. Please try again later.";
}

// Handle fatal errors
register_shutdown_function('handle_shutdown');
function handle_shutdown()
{
    $error = error_get_last();            // Check for error in script
    if ($error !== null) {                // If there was an error next line throws exception
        $e = new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
        handle_exception($e);             // Call exception handler
    }
}