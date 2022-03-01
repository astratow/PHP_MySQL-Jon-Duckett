<?php
declare(strict_types = 1);                               // Use strict types
require 'includes/database-connection.php';              // Create PDO object
require 'includes/functions.php';                        // Include functions

$sql = "SELECT a.id, a.title, a.summary, a.category_id, a.member_id, 
               c.name AS category,
               CONCAT(m.forename, ' ', m.surname) AS author,
               i.file     AS image_file,
               i.alt      AS image_alt 
          FROM article    AS a
          JOIN category   AS c ON a.category_id = c.id
          JOIN member     AS m ON a.member_id   = m.id
          LEFT JOIN image AS i ON a.image_id    = i.id
         WHERE a.published = 1
      ORDER BY a.id DESC
         LIMIT 6;";                                      // SQL to get latest articles
$articles = pdo($pdo, $sql)->fetchAll();                 // Get summaries

$sql = "SELECT id, name FROM category WHERE navigation = 1;"; // SQL to get categories
$navigation  = pdo($pdo, $sql)->fetchAll();              // Get navigation categories

$section     = '';                                       // Current category
$title       = 'Creative Folk';                          // HTML <title> content
$description = 'A collective of creatives for hire';     // Meta description content
?>
<?php include 'includes/header.php'; ?>
  <main class="container grid" id="content">
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
  </main>
<?php include 'includes/footer.php'; ?>