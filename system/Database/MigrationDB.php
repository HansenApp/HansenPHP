<?php

namespace Hansen\system\Database;

class MigrationDB
{
    public \PDO $pdo;
    public string $table;

    public function __construct($table, $pdo)
    {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    public function addColumn($name, $type, int $length = 255)
    {
        $type = strtolower($type);
        if ($type == 'string') {
            $this->pdo->exec("ALTER TABLE " . $this->table ."
                                       ADD COLUMN $name VARCHAR($length) NOT NULL");
        } elseif ($type == 'number') {
            $this->pdo->exec("ALTER TABLE " . $this->table ."
                                       ADD COLUMN $name INT($length) NOT NULL");
        } elseif ($type == 'double') {
            $this->pdo->exec("ALTER TABLE " . $this->table ."
                                       ADD COLUMN $name DOUBLE($length) NOT NULL");
        } elseif ($type == 'timestamp') {
            $this->pdo->exec("ALTER TABLE " . $this->table ."
                                       ADD COLUMN $name TIMESTAMP DEFAULT CURRENT_TIMESTAMP");
        } else {
            die;
        }
    }
}