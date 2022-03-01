<?php
declare(strict_types = 1);                                // Use strict types
require 'includes/database-connection.php';               // Create PDO object
require 'includes/functions.php';                         // Include functions

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); // Validate id
if (!$id) {                                               // If no valid id
    include 'page-not-found.php';                         // Page not found
}

$sql = "SELECT a.title, a.summary, a.content, a.created, a.category_id, a.member_id, 
               c.name      AS category,
               CONCAT(m.forename, ' ', m.surname) AS author,
               i.file AS image_file,
               i.alt  AS image_alt 
          FROM article     AS a
          JOIN category    AS c  ON a.category_id = c.id
          JOIN member      AS m  ON a.member_id   = m.id
          LEFT JOIN image  AS i  ON a.image_id    = i.id
         WHERE a.id = :id  AND a.published = 1;";         // SQL statement

$article = $article = pdo($pdo, $sql, [$id])->fetch();    // Get article data
if (!$article) {                                          // If article not found
    include 'page-not-found.php';                         // Page not found
}

$sql = "SELECT id, name FROM category WHERE navigation = 1;"; // SQL to get categories
$navigation  = pdo($pdo, $sql)->fetchAll();               // Get navigation categories
$section     = $article['category_id'];                   // Current category
$title       = $article['title'];                         // HTML <title> content
$description = $article['summary'];                       // Meta description content
?>
<?php include 'includes/header.php'; ?>
  <main class="article container" id="content">
    <section class="image">
      <img src="uploads/<?= html_escape($article['image_file'] ?? 'blank.png') ?>" 
           alt="<?= html_escape($article['image_alt']) ?>">
    </section>
    <section class="text">
      <h1><?= html_escape($article['title']) ?></h1>
      <div class="date"><?= format_date($article['created']) ?></div>
      <div class="content"><?= html_escape($article['content']) ?></div>
      <p class="credit">
        Posted in <a href="category.php?id=<?= $article['category_id'] ?>"><?= html_escape($article['category']) ?></a> by <a href="member.php?id=<?= $article['member_id'] ?>">
          <?= html_escape($article['author']) ?></a>
      </p>
    </section>
  </main>
<?php include 'includes/footer.php'; ?>