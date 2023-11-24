<?php

//database.php
class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'qwerty';
    private $database = 'store';
    public $connection;

    public function connect()
    {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function disconnect()
    {
        if ($this->connection) {
            $this->connection->close();
        }
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);
        return $result;
    }

    public function fetchAssoc($result)
    {
        return $result->fetch_assoc();
    }
}
