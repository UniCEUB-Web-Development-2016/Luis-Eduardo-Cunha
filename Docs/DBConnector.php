<?php
class DBConnector
{
    private $ipAddr;
    private $dbName;
    private $dbType;
    private $dbPort;
    private $dbUser;
    private $dbPassword;
	
  
    public function connection(){
        $dbh = new PDO('mysql:host='.$this->getIpAddr().';port='.$this.$this->getDbPort().';dbname='.$this->getDbName());
        return $dbh;
    }
 }