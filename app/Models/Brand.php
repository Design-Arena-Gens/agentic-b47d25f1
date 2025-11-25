<?php

declare(strict_types=1);

namespace App\Models;

final class Brand extends Model
{
    protected string $table = 'brands';
    protected array $fillable = [
        'slug',
        'name',
        'tagline',
        'primary_color',
        'secondary_color',
        'meta_description',
        'meta_keywords',
    ];

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $result = $stmt->fetch();

        return $result ?: null;
    }
}
