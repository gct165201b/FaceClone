<?php
class Database {
    private $connection;
    private $host;
    private $username;
    private $password;
    private $database_name;


    // Constructor;

    public function __construct() {
        $this->connection = null;
        $this->host = '(your host name)';
        $this->username = 'your user name';
        $this->password = 'your password';
        $this->database_name = 'your database name';
    }

    public function connect() {
        try {
            $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->database_name, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the error mode to exceptions.
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return $this->connection;
    }
}
