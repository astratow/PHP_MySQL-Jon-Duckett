<?php
class Database extends PDO
{
    public function __construct(string $dsn, string $username, string $password, array $options = [])
    {
        $default_options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC; // Return data as array
        $default_options[PDO::ATTR_EMULATE_PREPARES]   = false;            // Emulate prepares off
        $default_options[PDO::ATTR_ERRMODE]            = PDO::ERRMODE_EXCEPTION; // Error settings
        $options = array_replace($default_options, $options);      // Replace defaults if supplied
        parent::__construct($dsn, $username, $password, $options); // Create PDO object
    }

    public function runSQL(string $sql, $arguments = null)
    {
        if (!$arguments) {                               // If no arguments
            return $this->query($sql);                   // Run SQL, return PDOStatement object
        }
        $statement = $this->prepare($sql);               // If still running prepare statement
        $statement->execute($arguments);                 // Execute SQL statement with arguments
        return $statement;                               // Return PDOStatement object
    }
}