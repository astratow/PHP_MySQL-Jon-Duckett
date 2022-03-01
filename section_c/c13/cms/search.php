<?php
declare(strict_types = 1);                                // Use strict types
require 'includes/database-connection.php';               // Create PDO object
require 'includes/functions.php';                         // Include functions

$term  = filter_input(INPUT_GET, 'term');                 // Get search term
$show  = filter_input(INPUT_GET, 'show', FILTER_VALIDATE_INT) ?? 3; // Limit
$from  = filter_input(INPUT_GET, 'from', FILTER_VALIDATE_INT) ?? 0; // Offset
$count = 0;                                               // Set count to 0
$articles = [];                                           // Set articles to empty array

if ($term) {                                              // If search term provided
    $arguments['term1'] = '%' . $term .'%';               // Store search term in array
    $arguments['term2'] = '%' . $term .'%';               // three times as placeholders
    $arguments['term3'] = '%' . $term .'%';               // cannot be repeated in SQL

    $sql = "SELECT COUNT(title)
              FROM article
             WHERE title   LIKE :term1
                OR summary LIKE :term2
                OR content LIKE :term3
               AND published = 1;";                       // How many articles match term
    $count = pdo($pdo, $sql, $arguments)->fetchColumn();  // Return count

    if ($count > 0) {                                     // If articles match term
        $arguments['show'] = $show;                       // Array for pagination
        $arguments['from'] = $from;                       // Array for pagination
        $sql = "SELECT a.id, a.title, a.summary, a.category_id, a.member_id, 
                       c.name      AS category,
                       CONCAT(m.forename, ' ', m.surname) AS author,
                       i.file      AS image_file,
                       i.alt       AS image_alt 
                  FROM article     AS a
                  JOIN category    AS c    ON a.category_id = c.id
                  JOIN member      AS m    ON a.member_id   = m.id
                  LEFT JOIN image  AS i    ON a.image_id    = i.id
                 WHERE a.title   LIKE :term1
                    OR a.summary LIKE :term2
                    OR a.content LIKE :term3
                   AND a.published = 1
              ORDER BY a.id DESC
                 LIMIT :show 
                OFFSET :from;";                              // Find matching articles
        $articles = pdo($pdo, $sql, $arguments)->fetchAll(); // Run query and get results
    }
}

if ($count > $show) {                                     // If matches is more than show
    $total_pages  = ceil($count / $show);                 // Calculate total pages
    $current_page = ceil($from / $show) + 1;              // Calculate current page
}

$sql = "SELECT id, name FROM category WHERE navigation = 1;"; // SQL to get categories
$navigation  = pdo($pdo, $sql)->fetchAll();               // Get navigation categories
$section     = '';                                        // Current category
$title       = 'Search results for ' . $term;             // HTML <title> content
$description = $title . ' on Creative Folk';              // Meta description content
?>
<?php include 'includes/header.php'; ?>
  <main class="container" id="content">
    <section class="header">
      <form action="search.php" method="get" class="form-search">
        <label for="search"><span>Search for: </span></label>
        <input type="text" name="term" value="<?= html_escape($term) ?>" 
               id="search" placeholder="Enter search term"  
        /><input type="submit" value="Search" class="btn btn-search" />
      </form>
      <?php if ($term) { ?><p><b>Matches found:</b> <?= $count ?></p><?php } ?>
    </section>

    <section class="grid">
      <?php foreach ($articles as $article) { ?>
      <article class="summary">
        <a href="article.php?id=<?= $article['id'] ?>">
          <img src="uploads/<?= html_escape($article['image_file'] ?? 'blank.png') ?>"
               alt="<?= html_escape($article['image_alt']) ?>">
          <h2><?= html_escape($article['title']) ?></h2>
          <p><?= html_escape($article['summary']) ?></p>
        </a>
        <p class="credit">
          Posted in <a href="category.php?id=<?= $article['category_id'] ?>">
          <?= html_escape($article['category']) ?></a>
          by <a href="member.php?id=<?= $article['member_id'] ?>">
          <?= html_escape($article['author']) ?></a>
        </p>
      </article>
      <?php } ?>
    </section>

    <?php if ($count > $show) { ?>
    <nav class="pagination" role="navigation" aria-label="Pagination Navigation">
      <ul>
      <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
        <li>
          <a href="?term=<?= $term ?>&show=<?= $show ?>&from=<?= (($i - 1) * $show) ?>"
            class="btn <?= ($i == $current_page) ? 'active" aria-current="true' : '' ?>">
            <?= $i ?>
          </a>
        </li>
      <?php } ?>
      </ul>
    </nav>
    <?php } ?>

  </main>
<?php include 'includes/footer.php'; ?>