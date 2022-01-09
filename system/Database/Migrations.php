<?php

namespace Hansen\system\Database;

use PDO;

class Migrations
{
    public PDO $pdo;

    public function __construct()
    {
        $dsn = env("DB_DRIVER") . ":host=" . env("DB_HOST") . ";port=" .  env("DB_PORT") . ";dbname=" . env("DB_NAME");
        $user = env('DB_USER');
        $password = env('DB_PASSWORD');
        $this->pdo = new PDO($dsn, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function rollbackMigrations()
    {
        $files = scandir(__DIR__ . "/../../database/migrations");
        foreach ($files as $migration) {
            if ($migration == '.' || $migration == '..') continue;
            $migration = str_replace('.php', '', $migration);

            // $this->log($migration);
            $class = 'Hansen\\database\\migrations\\' . $migration;
            $instance = new $class;
            $this->log("Rollbacking $migration");
            $instance->down();
            $this->log("Rollbacked $migration");
        }
        $this->pdo->exec("DROP TABLE migrations");
    }

    public function applyMigrations()
    {
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $files = scandir(__DIR__ . "/../../database/migrations");
        $toApplyMigrations = array_diff($files, $appliedMigrations);

        $newMigrations = [];

        foreach ($toApplyMigrations  as $migration) {
            if ($migration == '.' || $migration == '..') {
                continue;
            }

            require_once __DIR__ . "/../../database/migrations/" . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $class = 'Hansen\\database\\migrations\\' . $className;
            $instance = new $class;
            $this->log("Applying $migration");
            $instance->up();
            $this->log("Applied $migration\n");

            $newMigrations[] = $migration;
        }

        if (!empty($newMigrations)) {
            $this->saveMigrations($newMigrations);
        } else {
            $this->log("All migrations are applied");
        }
    }

    protected function createMigrationsTable()
    {
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;");
    }

    protected function getAppliedMigrations()
    {
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    protected function saveMigrations(array $migrations)
    {
        $str = implode(",", array_map(fn ($m) => "('$m')", $migrations));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
        $str");
        $statement->execute();
    }

    public function addTable($name)
    {
        $this->pdo->exec("CREATE TABLE $name (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY 
)");
        return new MigrationDB($name, $this->pdo);
    }

    public function removeTable($name)
    {
        $this->pdo->exec("DROP TABLE $name");
    }

    protected function log($message)
    {
        echo PHP_EOL . '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }
}