<?php

declare(strict_types=1);

namespace App\Models;

final class Role extends Model
{
    protected string $table = 'roles';
    protected array $fillable = [
        'name',
        'slug',
        'permissions',
    ];

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $role = $stmt->fetch();
        return $role ?: null;
    }
}
