<?php
declare(strict_types = 1);                                           // Use strict types

$data['term']      = filter_input(INPUT_GET, 'term');                // Get search term
$data['show']      = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 3; // Limit
$data['from']      = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset

$data['count']     = 0;                                              // Set count to 0
$data['$articles'] = [];                                             // Set articles to empty array

if ($data['term']) {                                                 // If no search term
    $data['count'] = $cms->getArticle()->searchCount($data['term']); // Get number of matches
    if ($data['count'] > 0) {                                        // If there are matches
        $data['articles'] = $cms->getArticle()->search($data['term'], $data['show'], $data['from']); // Get matches
    }
}

if ($data['count'] > $data['show']) {                                // If more than 3 results
    $data['total_pages']  = ceil($data['count'] / $data['show']);    // Total pages
    $data['current_page'] = ceil($data['from'] / $data['show']) + 1; // Current page
}

$data['navigation']  = $cms->getCategory()->getAll();                // Get categories

echo $twig->render('search.html', $data);                            // Render Twig template