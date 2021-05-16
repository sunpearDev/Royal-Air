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

    public function rowEffect($sql, $data = [], $fetchMode = PDO::FETCH_ASSOC)
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

    public function execute1($sql, $data = [], $fetchMode = PDO::FETCH_ASSOC)
    {
        if ($this->connection == null) {
            die("Can't connect database.");
        }
        $stm = $this->connection->prepare($sql);



        if ($stm->execute($data)) {
            return $stm->fetchAll();
        } else {
            print_r($stm->errorInfo());
            die();
        }
    }

    function beginTransaction()
    {
        $this->connection->beginTransaction();
    }
    function commit()
    {
        $this->connection->commit();
    }
    function rollback()
    {
        $this->connection->rollBack();
    }
    function encrypt($string)
    {
        $output = '';

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
    function decrypt($string)
    {
        $output = '';

        $encrypt_method = "AES-256-CBC";
        $secret_key = 'This is my secret key';
        $secret_iv = 'This is my secret iv';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        return $output;
    }
    function getAll($table)
    {
        return $this->query("select * from $table");
    }
    function getBy($table, $id)
    {
        return $this->query("select * from $table where " . $id['name'] . " = '" . $id['value'] . "'");
    }
    function getMultiTable($table, $id)
    {
        $sql = "select * from $table[0] join $table[1] on $table[0]." . $id['name'] . "=$table[1]." . $id['name'] . " where $table[0]." . $id['name'] . " = '" . $id['value'] . "'";
        return $this->query($sql);
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
        $res = $this->execute($sql . $param1 . ' values ' . $param2, $data);
        if ($res > 0) return true;
        else return false;
    }
    function update($table, $id, $data)
    {
        $sql = "update $table set ";
        foreach ($data as $key => $val) {
            $sql .= $key . '=:' . $key . ' ,';
        }
        $sql[strlen($sql) - 1] = ' ';
        if (count($id) < 3)
            $sql .= " where " . $id['name'] . " ='" . $id['value'] . "'";
        else {
            $sql .= " where " . $id['name1'] . " ='" . $id['value1'] . "' and " . $id['name2'] . " =" . $id['value2'];
        }
        //echo $sql;
        $res = $this->execute($sql, $data);
        if ($res > 0) return true;
        else return false;
    }
    function delete($table, $id)
    {
        $sql = "delete from $table where " . $id['name'] . " = " . $id['value'];
        $res = $this->execute($sql);
        if ($res > 0) return true;
        else return false;
    }
}
