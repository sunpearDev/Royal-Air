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
        $stm = $this->pdo->prepare($sql);
        if ($stm->execute($data)) {
            return $stm->fetchAll($fetchMode);
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
        foreach ($data as $key => $val) {
            $param1 .= ':' . $key . ' ,';
        }
        $param1[strlen($param1)] = ')';
        $param2 = $param1;
        while (strpos(':', $param2)) {
            $param1[strpos(':', $param2)] = '';
        }
        return $this->execute($sql + $param2 + ' values ' + $param1, $data);
    }
    function update($table, $id, $data)
    {
        $sql = "update $table set ";
        foreach ($data as $key => $val) {
            $sql .= $key . '=:' . $key . ' ,';
        }
        $sql[strlen($sql)] = ' ';
        $sql .= "where" . $id['name'] . " ='" . $id['value'] . "'";
        return $this->execute($sql, $data);
    }
    function delete($table, $id)
    {
        $sql = "delete from $table where " . $id['name'] . " = " . $id['value'];
        return $this->execute($sql);
    }
}
