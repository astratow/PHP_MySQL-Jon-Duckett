<?php

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
        $sql = "SELECT id, forename, surname, joined, picture 
                FROM member
               WHERE id = :id;";                         // SQL to get member
        return $this->db->runSQL($sql, [$id])->fetch();  // Return member
    }

    // Get details of all members
    public function getAll(): array
    {
        $sql = "SELECT id, forename, surname, joined, picture 
                FROM member;";                           // SQL to get all members
        return $this->db->runSQL($sql)->fetchAll();      // Return all members
    }

}