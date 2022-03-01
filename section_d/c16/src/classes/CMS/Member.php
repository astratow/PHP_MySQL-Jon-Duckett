<?php
namespace PhpBook\CMS;                                   // Namespace declaration

class Member
{
    protected $db;                                       // Holds ref to Database object

    public function __construct(Database $db)
    {
        $this->db = $db;                                 // Add ref to Database object
    }

    // Get individual member by id
    public function get(int $id)
    {
        $sql = "SELECT id, forename, surname, email, joined, picture, role 
                  FROM member
                 WHERE id = :id;";                       // SQL to get member
        return $this->db->runSQL($sql, [$id])->fetch();  // Return member
    }

    // Get details of all members
    public function getAll(): array
    {
        $sql = "SELECT id, forename, surname, joined, picture, role 
                  FROM member;";                         // SQL to get all members
        return $this->db->runSQL($sql)->fetchAll();      // Return all members
    }

    // Get individual member data using their email
    public function getIdByEmail(string $email)
    {
        $sql = "SELECT id
                  FROM member
                 WHERE email = :email;";                         // SQL query to get member id
        return $this->db->runSQL($sql, [$email])->fetchColumn(); // Run SQL and return member id
    }

    // Login: returns member data if authenticated, false if not
    public function login(string $email, string $password)
    {
        $sql = "SELECT id, forename, surname, joined, email, password, picture, role 
                  FROM member 
                 WHERE email = :email;";                         // SQL to get member data
        $member = $this->db->runSQL($sql, [$email])->fetch();    // Run SQL
        if (!$member) {                                          // If no member found
            return false;                                        // Return false
        }                                                        // Otherwise
        $authenticated = password_verify($password, $member['password']); // Passwords match?
        return ($authenticated ? $member : false);               // Return member or false
    }

    // Get total number of members
    public function count(): int
    {
        $sql = "SELECT COUNT(id) FROM member;";                  // SQL to count number of members
        return $this->db->runSQL($sql)->fetchColumn();           // Run SQL and return count
    }

    // Create a new member
    public function create(array $member): bool
    {
        $member['password'] = password_hash($member['password'], PASSWORD_DEFAULT);  // Hash password
        try {                                                          // Try to add member
            $sql = "INSERT INTO member (forename, surname, email, password) 
                    VALUES (:forename, :surname, :email, :password);"; // SQL to add member
            $this->db->runSQL($sql, $member);                          // Run SQL
            return true;                                               // Return true
        } catch (\PDOException $e) {                                   // If PDOException thrown
            if ($e->errorInfo[1] === 1062) {                           // If error indicates duplicate entry
                return false;                                          // Return false to indicate duplicate name
            }                                                          // Otherwise
            throw $e;                                                  // Re-throw exception
        }
    }

    // Update an existing member
    public function update(array $member): bool
    {
        unset($member['joined'],  $member['picture']);                // Remove joined and member from array
        try {                                                         // Try to update member
            $sql = "UPDATE member 
                       SET forename = :forename, surname = :surname, email = :email, role = :role 
                     WHERE id = :id;";                                // SQL to update member
            $this->db->runSQL($sql, $member);                         // Run SQL
            return true;                                              // Return true
        } catch (\PDOException $e) {                                  // If PDOException thrown
            if ($e->errorInfo[1] == 1062) {                           // If a duplicate (email in use)
                return false;                                         // Return false
            }                                                         // Any other error
            throw $e;                                                 // Re-throw exception
        }
    }

    // Upload member profile image
    public function pictureCreate(int $id, string $filename, string $temporary, string $destination): bool
    {
        if ($temporary) {                                    // If an image was uploaded
            $image = new \Imagick($temporary);               // Object to represent image
            $image->cropThumbnailImage(350, 350);            // Create cropped image
            $saved = $image->writeImage($destination);       // Save file
            if ($saved == false) {                           // If save failed
                throw new Exception('Unable to save image'); // Throw an exception
            }
        }
        $filename = basename($destination);
        $sql = "UPDATE member 
                   SET picture = :picture
                 WHERE id = :id;";                                   // SQL to create picture
        $this->db->runSQL($sql, ['id'=>$id, 'picture'=>$filename],); // Run SQL pass in user id and filename
        return true;                                                 // Done return true
    }

    // Delete member profile image
    public function pictureDelete(int $id, string $path): bool
    {
        $unlink = unlink($path);                         // Delete image file
        if ($unlink === false) {                         // If failed throw exception
            throw new Exception('Unable to delete image or image is missing');
        }
        $sql = "UPDATE member 
                   SET picture = null
                 WHERE id = :id;";                       // SQL to set picture to null
        $this->db->runSQL($sql, ['id'=>$id,]);           // Run SQL
        return true;                                     // Return true
    }

    // Update member password
    public function passwordUpdate(int $id, string $password): bool
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);           // Hash the password
        $sql = 'UPDATE member 
                   SET password = :password 
                 WHERE id = :id;';                                    // SQL to update password
        $this->db->runSQL($sql, ['id' => $id, 'password' => $hash,]); // Run SQL
        return true;                                                  // Return true
    }
}