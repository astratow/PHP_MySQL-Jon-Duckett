<?php
declare(strict_types = 1);                               // Use strict types

include '../src/bootstrap.php';                          // Setup file

$cms->getSession()->delete();                            // Call method to end session
redirect('');                                            // Redirect to home page