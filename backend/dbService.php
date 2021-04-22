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
    function query($sql)
    {
        $stm = $this->connection->query($sql);
        $data = $stm->fetchAll();
        return $data;
    }
    function execute($sql, $param = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        if ($this->connection == null) {
            die("Can't connect database.");
        }
        $stm = $this->pdo->prepare($sql);
        if ($stm->execute($param)) {
            return $stm->fetchAll($fetchMode);
        } else {
            print_r($stm->errorInfo());
            die();
        }
    }
}
