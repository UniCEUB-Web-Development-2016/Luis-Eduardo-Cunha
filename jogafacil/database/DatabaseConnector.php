<?php


class DatabaseConnector
{
    private $ip;
    private $dbname;
    private $type;
    private $port;
    private $user;
    private $password;

    public function __construct($ip, $dbname, $type,$port, $user, $password)
    {
        $this->ip = $ip;
        $this->dbname = $dbname;
        $this->type = $type;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
    }

    public function getConnection()
    {
        $connString = $this->type . ':host=' . $this->ip . ';dbname=' . $this->dbname;
        try {
            $conn = new PDO($connString,
                $this->user,
                $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


}