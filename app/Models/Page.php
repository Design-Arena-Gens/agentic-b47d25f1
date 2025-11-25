<?php

declare(strict_types=1);

namespace App\Models;

final class Page extends Model
{
    protected string $table = 'pages';
    protected array $fillable = [
        'brand_id',
        'slug',
        'title',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
    ];

    public function findBySlugAndBrand(string $slug, int $brandId): ?array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE slug = :slug AND brand_id = :brand_id AND is_active = 1 LIMIT 1");
        $stmt->execute(['slug' => $slug, 'brand_id' => $brandId]);
        $page = $stmt->fetch();
        return $page ?: null;
    }
}
