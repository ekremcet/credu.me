<?php

const HOST_NAME = "localhost";
const HOST_USER = "root";
const HOST_PASSWORD = "3448";
const DATABASE_NAME = "credu.me";

class DatabaseConnection {

    private $connection = null;
    private $hostName = "localhost";
    private $hostUser = "root";
    private $hostPassword = "3448";
    private $databaseName = "credu.me";

    public function __construct() {

    }

    public function initiateConnection() {
        $this->connection = new mysqli($this->hostName, $this->hostUser, $this->hostPassword, $this->databaseName);
        
        if (!$this->connection)
            die("Connection Failed!");
    }

    public function killConnection() {
        mysqli_close($this->connection);
    }

    public function getConnection() {
        return $this->connection;
    }
}

?>