<?php
class CMS
{
    protected $db        = null;                   // Stores reference to Database object
    protected $article   = null;                   // Stores reference to Article object
    protected $category  = null;                   // Stores reference to Category object
    protected $member    = null;                   // Stores reference to Member object

    public function __construct($dsn, $username, $password)
    {
        $this->db = new Database($dsn, $username, $password); // Create Database object
    }

    public function getArticle()
    {
        if ($this->article === null) {                        // If $article property null
            $this->article = new Article($this->db);          // Create Article object
        }
        return $this->article;                                // Return Article object
    }

    public function getCategory()
    {
        if ($this->category === null) {                       // If $category property null
            $this->category = new Category($this->db);        // Create Category object
        }
        return $this->category;                               // Return Category object
    }

    public function getMember()
    {
        if ($this->member === null) {                         // If $member property null
            $this->member = new Member($this->db);            // Create Member object
        }
        return $this->member;                                 // Return Member object
    }
}