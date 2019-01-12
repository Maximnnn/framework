<?php
namespace Framework\Storage\DB;

use Framework\Storage\StorageConnectionInterface;

class MySqlConnection implements StorageConnectionInterface {

    protected $pdo;

    public function __construct($dsn, $username, $psw, $opt = [])
    {
        $this->pdo = new PDO($dsn, $username, $psw, $opt);
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}