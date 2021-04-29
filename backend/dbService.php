<?php
require_once "dbConfig.php";
class DbServices
{
    private $connection = null;
    function __construct()
    {
        if ($this->connection == null) {
            try {
                $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD, PDOATTRS);
            } catch (PDOException $exception) {
                die($exception->getMessage());
            }
        }
    }
    private function query($sql)
    {
        if ($this->connection == null) {
            die("Can't connect database.");
        }
        $stm = $this->connection->query($sql);
        $data = $stm->fetchAll();
        return $data;
    }
    private function execute($sql, $data = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        if ($this->connection == null) {
            die("Can't connect database.");
        }
        $stm = $this->connection->prepare($sql);

         

        if ($stm->execute($data)) {
            return $stm->rowCount();
        } else {
            print_r($stm->errorInfo());
            die();
        }
    }
    function getAll($table)
    {
        return $this->query("select * from $table");
    }
    function getOne($table, $id)
    {
        return $this->query("select * from $table where " . $id['name'] . " = '" . $id['value'] . "'");
    }
    function create($table, $data)
    {
        $sql = "insert into $table ";

        $param1 = '(';
        $param2 = '(';
        foreach ($data as $key => $val) {
            $param1 .= $key . ' ,';
            $param2 .= ':' . $key . ' ,';
        }
        $param1[strlen($param1) - 1] = ')';
        $param2[strlen($param2) - 1] = ')';
        $res=$this->execute($sql . $param1 . ' values ' . $param2, $data);
        if ($res>0) return true;
        else return false;
    }
    function update($table, $id, $data)
    {
        $sql = "update $table set ";
        foreach ($data as $key => $val) {
            $sql .= $key . '=:' . $key . ' ,';
        }
        $sql[strlen($sql)] = ' ';
        $sql .= "where" . $id['name'] . " ='" . $id['value'] . "'";
        
        $res=$this->execute($sql, $data);
        if ($res>0) return true;
        else return false;
    }
    function delete($table, $id)
    {
        $sql = "delete from $table where " . $id['name'] . " = " . $id['value'];
        $res=$this->execute($sql);
        if ($res>0) return true;
        else return false;
    }
}
