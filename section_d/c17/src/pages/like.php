<?php
declare(strict_types = 1);                               // Use strict types

if (!$id or $session->id == 0) {                         // If no valid id
    include APP_ROOT . '/src/pages/page-not-found.php';  // Page not found
}

$liked = $cms->getLike()->get([$id, $session->id]);      // Does member like
if ($liked) {                                            // If they like it already
    $cms->getLike()->delete([$id, $session->id]);        // Remove like
} else {                                                 // Otherwise
    $cms->getLike()->create([$id, $session->id]);        // Add like
}
redirect('article/' . $id . '/' . $parts[2] . '/');      // Redirect to article page