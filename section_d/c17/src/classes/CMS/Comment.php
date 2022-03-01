<?php
namespace PhpBook\CMS;                                   // Declare namespace

class Comment
{                                                        // Define Comment class
    protected $db;                                       // Holds reference to Database object

    public function __construct(Database $db)            // Runs when object created using class
    {
        $this->db = $db;                                 // Store Database object in $db property
    }

    // Get all comments for article
    public function getAll(int $id): array
    {
        $sql = "SELECT c.id, c.comment, c.posted,
               CONCAT(m.forename, ' ', m.surname) AS author, m.picture
                 FROM comment AS c
                 JOIN member  AS m ON c.member_id = m.id 
                WHERE c.article_id = :id;";                        // SQL statement
        return $this->db->runSQL($sql, ['id' => $id])->fetchAll(); // Execute query
    }

    // Create article comment
    public function create(array $comment): bool
    {
        $sql = "INSERT INTO comment (comment, article_id, member_id) 
                VALUES (:comment, :article_id, :member_id);"; // SQL statement
        $this->db->runSQL($sql, $comment);                    // Execute query
        return true;
    }

}