<?php
class dataBase
{
    private $connection = null;

    function __construct()
    {
        $serverName = "127.0.0.1";
        $username = "root";
        $password = "123456789";

        try {
            $this->connection = new PDO("mysql:host=$serverName;dbname=gallery-project", $username, $password);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function returnConnection()
    {
        return $this->connection;
    }
}
