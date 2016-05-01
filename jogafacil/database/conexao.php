<?php

class DatabaseConnection {

    private $dbname     = "bd_redeSocial";
    private $host       = "localhost";
    private $user       = "postegres";
    private $password   = "luiseduardo93";
    private $port       = 5432;

    private $connection;

    public function __construct() {
        try {
            $this->connection  = new PDO("pgsql:host=$this->host;
            port=$this->port;dbname=$this->dbname;user=$this->user;password=$this->password");

        } catch(PDOException $e) {
            echo    $e->getMessage();
        }

    }

    public function disconnect() {
        $this->connection = null;
    }

    public function get_connection()
    {

        return $this->connection;

    }

}
?>