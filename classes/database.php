<?php


class Database{
    private $host = "localhost"; //127.0.0.1 - loopback
    private $username = "root";
    private $password = "";
    private $dbname = "library";

    protected $conn;

    public function connect(){
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname",$this->username, $this->password);

        return $this->conn;
    }
}