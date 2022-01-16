<?php

namespace Hansen\system\Core;

use PDO;

class Model
{
    public PDO $pdo;
    private $stmt;

    public function connect()
    {
        $dsn = env("DB_DRIVER") . ":host=" . env("DB_HOST") . ";port=" .  env("DB_PORT") . ";dbname=" . env("DB_NAME");
        $user = env('DB_USER');
        $password = env('DB_PASSWORD');
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function insert($field, $value, $table)
    {
        $stmt = $this->pdo->prepare("INSERT INTO $table($field) VALUES ($value)");
        $stmt->execute();
    }

    public function delete($where, $table)
    {
        $stmt = $this->pdo->prepare("DELETE FROM $table WHERE $where");
        $stmt->execute();
    }
    
    public function query($query)
    {
        $this->stmt = $this->pdo->prepare($query);
    }
    
    protected function execute()
    {
        $this->stmt->execute();
    }
    
    public function all()
    {
        $this->execute();
        $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function single()
    {
        $this->execute();
        $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
