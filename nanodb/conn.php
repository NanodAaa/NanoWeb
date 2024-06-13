<?php

include_once("../config/config.php");

class nanoSqlDB
{
    private $dbname;
    private $conn;

    public function __construct($dbname)
    {
        $this->dbname = $dbname;
    }

    // Connect Function
    public function connect()
    {
        $this->conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, $this->dbname);
    //    echo SERVER_NAME, USERNAME, PASSWORD, $this->dbname;
        if ($this->conn->connect_error) 
        {
            die("Failed to connect to nanodb!". $this->conn->connect_error);
        }
    }

    // Query Function
    // @param $sql The command to
    // @return The query result if success.
    public function query($sql)
    {
        $result = $this->conn->query($sql);
        if (!$result)
        {
            die("Failed to query!". $this->conn->error);
        }
        return $result;
    }

    // Close connection
    public function close()
    {
        $this->conn->close();
        if (!$this->conn)
        {
            die("Closing failure!". $this->conn->error);
        }
    }
}