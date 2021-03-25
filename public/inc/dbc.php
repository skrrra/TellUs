<?php

class Dbc{

    private ?mysqli $conn = null;

    public function __construct(){
        $this->connect();
    }


    public function getConn(): mysqli
    {
        if (!$this->conn) {
            $this->connect();
        }

        return $this->conn;
    }

    private function connect()
    {
        $username = "testadmin";
        $password = "admin";
        $dbname = "chat";
        $server = "localhost";

        $this->conn = new mysqli($server, $username, $password, $dbname);
    }
}