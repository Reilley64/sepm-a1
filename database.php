<?php
class Database
{
    private $connection;

    public function __construct()
    {
        $this->connection = new mysqli('us-cdbr-iron-east-02.cleardb.net', 'b6f2dc62df28b0', 'fa6c774d', 'heroku_2d9257028881513');
        
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function delete($sql)
    {
        if ($this->connection->query($sql) === true) {
            return true;
        } else {
            return $this->connection->error;
        }
    }

    public function insert($sql)
    {
        if ($this->connection->query($sql) === true) {
            return true;
        } else {
            return $this->connection->error;
        }
    }

    public function select($sql)
    {
        $result = $this->connection->query($sql);
        if (!$result) {
            die($this->connection->error);
        }

        $data = array();
        $count = 0;
        while ($person = $result->fetch_object()) {
            $data[$count] = $person;
            $count++;
        }

        mysqli_free_result($result);
        return $data;
    }

    public function selectAll($table)
    {
        $result = $this->connection->query('SELECT * FROM ' . $table . ';');
        if (!$result) {
            die($this->connection->error);
        }

        $data = array();
        $count = 0;
        while ($person = $result->fetch_object()) {
            $data[$count] = $person;
            $count++;
        }

        mysqli_free_result($result);
        return $data;
    }
}
