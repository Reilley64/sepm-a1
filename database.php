<?php
class Database
{
    private $connection;

    public function __construct()
    {
        $this->$connection = new mysqli('us-cdbr-iron-east-03.cleardb.net', 'bb7eebe8e43a41', '5028cdab', 'heroku_7c5b74577fd439b');
        
        if ($this->$connection->connect_error) {
            die("Connection failed: " . $this->$connection->connect_error);
        }
    }

    public function delete($sql)
    {
        if ($this->$connection->query($sql) === true) {
            return true;
        } else {
            return $this->$connection->error;
        }
    }

    public function insert($sql)
    {
        if ($this->$connection->query($sql) === true) {
            return true;
        } else {
            return $this->$connection->error;
        }
    }

    public function select($sql)
    {
        $result = $this->$connection->query($sql);
        if (!$result) {
            die($this->$connection->error);
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
        $result = $this->$connection->query('SELECT * FROM ' . $table . ';');
        if (!$result) {
            die($this->$connection->error);
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
