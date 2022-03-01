<?php
namespace PhpBook\CMS;                                   // Namespace declaration

class Category
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Add ref to Database object
    }

    // Get individual category
    public function get(int $id)
    {
        $sql = "SELECT id, name, description, navigation, seo_name 
                  FROM category 
                 WHERE id = :id;";                       // SQL to get one category
        return $this->db->runSQL($sql, [$id])->fetch();  // Return category data
    }

    // Get all categories
    public function getAll(): array
    {
        $sql = "SELECT id, name, navigation, seo_name 
                  FROM category;";                       // SQL to get all categories
        return $this->db->runSQL($sql)->fetchAll();      // Return all categories
    }

    // ADMIN METHODS
    // Get number of categories
    public function count(): int
    {
        $sql = "SELECT COUNT(id) FROM category;";        // SQL to count categories
        return $this->db->runSQL($sql)->fetchColumn();   // Return category count
    }

    // Create new category
    public function create(array $category): bool
    {
        try {                                            // Try to create category
            $sql = "INSERT INTO category (name, description, navigation, seo_name) 
                    VALUES (:name, :description, :navigation, :seo_name);"; // SQL to add new category
            $this->db->runSQL($sql, $category);          // Add new category
            return true;                                 // It worked, return true
        } catch (\PDOException $e) {                     // If a exception was thrown
            if ($e->errorInfo[1] === 1062) {             // If error indicates duplicate entry
                return false;                            // Return false to indicate duplicate name
            } else {                                     // Otherwise
                throw $e;                                // Re-throw exception
            }
        }
    }

    // Update existing category
    public function update(array $category): bool
    {
        try {                                            // Try to update category
            $sql = "UPDATE category 
                       SET name = :name, description = :description, navigation = :navigation, seo_name = :seo_name 
                     WHERE id = :id;";                   // SQL to update category
            $this->db->runSQL($sql, $category);          // Update category
            return true;                                 // It worked, return true
        } catch (\PDOException $e) {                     // If exception thrown
            if ($e->errorInfo[1] === 1062) {             // If duplicate entry
                return false;                            // Return false to indicate duplicate name
            } else {                                     // If any other exception
                throw $e;                                // Re-throw exception
            }
        }
    }

    // Delete existing category
    public function delete(int $id): bool
    {
        try {                                            // Try to delete category
            $sql = "DELETE FROM category 
                 WHERE id = :id;";                       // SQL to delete category
            $this->db->runSQL($sql, [$id]);              // Delete category
            return true;                                 // It worked, return true
        } catch (\PDOException $e) {                     // If exception was thrown
            if ($e->errorInfo[1] === 1451) {             // If error is integrity constraint
                return false;                            // Return false indicating articles exist in this category
            } else {                                     // If any other exception
                throw $e;                                // Re-throw exception
            }
        }
    }

}