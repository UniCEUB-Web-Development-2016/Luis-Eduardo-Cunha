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
        $stringPDO = $this->type.":host=".$this->ip.";dbname=".$this->dbname;

        try{
            $connection = new PDO($stringPDO,
                $this->user,
                $this->password);

        }catch(PDOException $e)
        {
            var_dump($e);
        }

        return $connection;
    }


}