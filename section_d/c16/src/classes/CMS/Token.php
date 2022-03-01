<?php
namespace PhpBook\CMS;                                   // Declare namespace

class Token
{
    protected $db;                                       // Holds reference to Database object

    public function __construct(Database $db)            // Runs when object created using class
    {
        $this->db = $db;                                 // Store Database object in $db property
    }

    // Create a new token (requires member id and purpose of token)
    public function create(int $id, string $purpose): string
    {
        $arguments['token']     = bin2hex(random_bytes(64));                   // Token
        $arguments['expires']   = date("Y-m-d H:i:s", strtotime('+4 hours'));  // Expiry
        $arguments['member_id'] = $id;                                         // Member id
        $arguments['purpose']   = $purpose;                                    // Purpose
        $sql     = "INSERT INTO token (token, member_id, expires, purpose)
                    VALUES (:token, :member_id, :expires, :purpose);"; // SQL to add token to database
        $this->db->runSQL($sql, $arguments);                           // Run SQL statement
        return $arguments['token'];                                    // Return new token
    }

    // Check if token is valid
    public function getMemberId(string $token, string $purpose): ?int
    {
        $sql = "SELECT member_id
                  FROM token
                 WHERE token = :token AND purpose = :purpose
                   AND expires > NOW();";                                                          // SQL to check if token is valid and
        return $this->db->runSQL($sql, ['token' => $token, 'purpose' => $purpose])->fetchColumn(); // Run SQL and return
    }
}