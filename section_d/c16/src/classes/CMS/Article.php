<?php
namespace PhpBook\CMS;                                   // Namespace declaration

class Article
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Add ref to Database object
    }

    // Get individual article
    public function get(int $id, bool $published = true)
    {
        $sql = "SELECT a.id, a.title, a.summary, a.content, a.created, a.category_id, 
                       a.member_id, a.published,
                       c.name     AS category,
                       CONCAT(m.forename, ' ', m.surname) AS author,
                       i.id       AS image_id, 
                       i.file     AS image_file, 
                       i.alt      AS image_alt 
                  FROM article    AS a
                  JOIN category   AS c ON a.category_id = c.id
                  JOIN member     AS m ON a.member_id   = m.id
                  LEFT JOIN image AS i ON a.image_id    = i.id
                 WHERE a.id = :id ";                     // SQL statement
        if ($published) {                                // If must be published
            $sql .= "AND a.published = 1 ";              // Add clause to SQL
        }
        return $this->db->runSQL($sql, [$id])->fetch();  // Return article
    }

    // Get summaries of articles
    public function getAll($published = true, $category = null, $member = null, $limit = 1000): array
    {
        $arguments['category']  = $category;             // Category id
        $arguments['category1'] = $category;             // Category id
        $arguments['member']    = $member;               // Author id
        $arguments['member1']   = $member;               // Author id
        $arguments['limit']     = $limit;                // Max articles to return

        $sql = "SELECT a.id, a.title, a.summary, a.created, a.category_id, a.member_id, a.published,
                     c.name     AS category,
                     CONCAT(m.forename, ' ', m.surname) AS author,
                     i.file     AS image_file, 
                     i.alt      AS image_alt 

                FROM article    AS a
                JOIN category   AS c ON a.category_id = c.id
                JOIN member     AS m ON a.member_id   = m.id
                LEFT JOIN image AS i ON a.image_id    = i.id 

              WHERE (a.category_id = :category OR :category1 is null)
                AND (a.member_id   = :member   OR :member1   is null) ";  // SQL for article summary

        if ($published) {                                // If published argument is true
            $sql .= "AND a.published = 1 ";              // Only get published articles
        }
        $sql .= "ORDER BY a.id DESC
                 LIMIT :limit;";                         // Add: order and max number of articles to return

        return $this->db->runSQL($sql, $arguments)->fetchAll(); // Return data
    }

    // SEARCH
    // Get number of search matches
    public function searchCount(string $term): int
    {
        $arguments['term1'] = '%' . $term . '%';         // Add wildcards to search term
        $arguments['term2'] = '%' . $term . '%';         // Add wildcards to search term
        $arguments['term3'] = '%' . $term . '%';         // Add wildcards to search term
        $sql   = "SELECT COUNT(title)
                FROM article
               WHERE article.title   LIKE :term1 
                  OR article.summary LIKE :term2 
                  OR article.content LIKE :term3
                 AND article.published = 1;";            // SQL to count matches
        return $this->db->runSQL($sql, $arguments)->fetchColumn(); // Return number of matches
    }

    // Get article summaries of search matches
    public function search(string $term, int $show = 3, int $from = 0): array
    {
        $arguments['term1'] = '%' . $term . '%';         // Add wildcards to search term
        $arguments['term2'] = '%' . $term . '%';         // Add wildcards to search term
        $arguments['term3'] = '%' . $term . '%';         // Add wildcards to search term
        $arguments['show']  = $show;                     // Number of results to show
        $arguments['from']  = $from;                     // Number of results to skip
        $sql  = "SELECT a.id, a.title, a.summary, a.created, a.category_id, a.member_id,
                     c.name      AS category,
                     CONCAT(m.forename, ' ', m.surname) AS author,
                     i.file      AS image_file, 
                     i.alt       AS image_alt

                FROM article     AS a
                JOIN category    AS c    ON a.category_id = c.id
                JOIN member      AS m    ON a.member_id   = m.id
                LEFT JOIN image  AS i    ON a.image_id    = i.id

               WHERE a.title     LIKE :term1 
                  OR a.summary   LIKE :term2
                  OR a.content   LIKE :term3
                 AND a.published = 1
               ORDER BY a.id DESC
               LIMIT :show 
              OFFSET :from;";                            // SQL to get article summaries
        return $this->db->runSQL($sql, $arguments)->fetchAll();  // Return article summaries
    }


    // ADMIN METHODS
    // Get number of articles
    public function count(): int
    {
        $sql = "SELECT COUNT(id) FROM article;";         // SQL to count articles
        return $this->db->runSQL($sql)->fetchColumn();   // Return count from result set
    }

    // Save new article
    public function create(array $article, string $temporary, string $destination): bool
    {
        try {                                            // Try to insert data
            $this->db->beginTransaction();               // Start transaction
            if ($destination) {                          // If image uploaded
                // Crop and save file
                $imagick = new \Imagick($temporary);     // Object to represent image
                $imagick->cropThumbnailImage(1200, 700); // Create cropped image
                $imagick->writeImage($destination);      // Save file

                $sql = "INSERT INTO image (file, alt)
                        VALUES (:file, :alt);";          // SQL to add image
                $this->db->runSQL($sql, [$article['image_file'], $article['image_alt']]); // Add image to table
                $article['image_id'] = $this->db->lastInsertId();  // Return image id
            }
            unset($article['image_file'], $article['image_alt']);
            $sql = "INSERT INTO article (title, summary, content, category_id, member_id,
                       image_id, published, seo_title)
                    VALUES (:title, :summary, :content, :category_id, :member_id,
                       :image_id, :published, :seo_title);"; // SQL to add article
            $this->db->runSQL($sql, $article);           // Add article
            $this->db->commit();                         // Commit transaction
            return true;                                 // Return true
        } catch (\PDOException $e) {                     // If PDOException was raised
            $this->db->rollBack();                       // Rollback transaction
            if (file_exists($destination)) {             // If image file exists
                unlink($destination);                    // Delete image file
            }
            if ($e->errorInfo[1] === 1062) {             // If an integrity constraint
                return false;                            // Return false
            } else {                                     // For all other reasons
                throw $e;                                // Re-throw exception
            }
        }
    }

    // Update existing article
    public function update(array $article, string $temporary, string $destination): bool
    {
        try {                                            // Try to update data
            $this->db->beginTransaction();               // Start transaction
            if ($destination) {                          // If image uploaded
                // Crop and save file
                $imagick = new \Imagick($temporary);     // Object to represent image
                $imagick->cropThumbnailImage(1200, 700); // Create cropped image
                $imagick->writeImage($destination);      // Save file

                $sql = "INSERT INTO image (file, alt)
                        VALUES (:file, :alt);";          // SQL to add image
                $this->db->runSQL($sql, [$article['image_file'], $article['image_alt']]);  // Add image to image table
                $article['image_id'] = $this->db->lastInsertId();  // Add image id to $article
            }
            // Remove unwanted elements from $article
            unset($article['category'], $article['created'], $article['author'], $article['image_file'], $article['image_alt']);
            $sql = "UPDATE article 
                       SET title = :title, summary = :summary, content = :content, 
                           category_id = :category_id, member_id = :member_id, 
                           image_id = :image_id, published = :published, seo_title = :seo_title 
                     WHERE id = :id;";                   // SQL statement
            $this->db->runSQL($sql, $article)->rowCount();  // Update article
            $this->db->commit();                         // Commit transaction
            return true;                                 // Update worked
        } catch (\PDOException $e) {                     // If PDOException was raised
            $this->db->rollBack();                       // Rollback transaction
            if (file_exists($destination)) {             // If image file exists
                unlink($destination);                    // Delete image file
            }
            if ($e->errorInfo[1] === 1062) {             // If an integrity constraint
                return false;                            // Return false
            } else {                                     // For all other reasons
                throw $e;                                // Re-throw exception
            }
        }
    }

    // Delete article
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM article WHERE id = :id;";    // SQL statement
        $this->db->runSQL($sql, [$id]);                  // Delete article
        return true;                                     // Return true
    }

    // Delete image from article
    public function imageDelete(int $image_id, string $path, int $article_id): bool
    {
        $sql = "UPDATE article SET image_id = null 
                 WHERE id = :article_id;";               // SQL statement
        $this->db->runSQL($sql, [$article_id]);          // Delete image from article
        $sql = "DELETE FROM image 
                 WHERE id = :id;";                       // SQL statement
        $this->db->runSQL($sql, [$image_id]);            // Delete image from image

        if (file_exists($path)) {                        // If image file exists
            unlink($path);                               // Delete image file
        }
        return true;                                     // Return true
    }

    // Update alt text for article image
    public function altUpdate(int $image_id, string $alt): bool
    {
        $sql = "UPDATE image SET alt = :alt 
                 WHERE id = :article_id;";               // SQL statement
        $this->db->runSQL($sql, [$alt, $image_id]);      // Delete image from article
        return true;                                     // Return true
    }
}