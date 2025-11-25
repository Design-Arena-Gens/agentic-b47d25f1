<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

abstract class Model
{
    protected string $table;
    protected array $fillable = [];

    protected function connection(): PDO
    {
        return Database::connection();
    }

    public function all(): array
    {
        $query = $this->connection()->query("SELECT * FROM {$this->table}");
        return $query->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        return $result ?: null;
    }

    public function create(array $attributes): int
    {
        $fields = array_intersect_key($attributes, array_flip($this->fillable));
        $columns = implode(',', array_keys($fields));
        $placeholders = ':' . implode(',:', array_keys($fields));

        $stmt = $this->connection()->prepare("INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})");
        $stmt->execute($fields);

        return (int) $this->connection()->lastInsertId();
    }

    public function update(int $id, array $attributes): bool
    {
        $fields = array_intersect_key($attributes, array_flip($this->fillable));
        $columns = implode(', ', array_map(fn ($key) => "{$key} = :{$key}", array_keys($fields)));

        $fields['id'] = $id;

        $stmt = $this->connection()->prepare("UPDATE {$this->table} SET {$columns} WHERE id = :id");
        return $stmt->execute($fields);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->connection()->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
