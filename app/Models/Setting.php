<?php

declare(strict_types=1);

namespace App\Models;

final class Setting extends Model
{
    protected string $table = 'settings';
    protected array $fillable = [
        'key',
        'value',
    ];

    public function get(string $key, $default = null)
    {
        $stmt = $this->connection()->prepare("SELECT value FROM {$this->table} WHERE `key` = :key LIMIT 1");
        $stmt->execute(['key' => $key]);
        $value = $stmt->fetchColumn();

        return $value !== false ? $value : $default;
    }

    public function set(string $key, string $value): void
    {
        $stmt = $this->connection()->prepare("INSERT INTO {$this->table} (`key`, `value`) VALUES (:key, :value) ON DUPLICATE KEY UPDATE `value` = :value");
        $stmt->execute(['key' => $key, 'value' => $value]);
    }
}
