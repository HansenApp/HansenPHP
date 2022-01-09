<?php

namespace Hansen\system\Core;

use PDO;

class Model
{
    private PDO $pdo;

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
}