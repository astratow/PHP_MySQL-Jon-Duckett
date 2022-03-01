<?php
set_exception_handler('handle_exception');                      // Set exception handler
function handle_exception($e)
{
    error_log($e);                                              // Log error
    http_response_code(500);                                    // Set response code
    require_once 'header.php';                                  // Ensure header included
    echo "<h1>Sorry, a problem occurred</h1>
          <p>The site's owners have been informed. Please try again later.</p>";
    require_once 'footer.php';                                  // Add footer
}

set_error_handler('handle_error');                              // Set error handler
function handle_error($type, $message, $file = '', $line = 0)
{
    throw new ErrorException($message, 0, $type, $file, $line); // Throw ErrorException
}