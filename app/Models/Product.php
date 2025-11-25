<?php

declare(strict_types=1);

namespace App\Models;

final class Product extends Model
{
    protected string $table = 'products';
    protected array $fillable = [
        'brand_id',
        'name',
        'slug',
        'short_description',
        'description',
        'price',
        'discount_price',
        'stock',
        'sku',
        'is_active',
        'is_featured',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function forBrand(int $brandId): array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE brand_id = :brand_id AND is_active = 1 ORDER BY created_at DESC");
        $stmt->execute(['brand_id' => $brandId]);
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE slug = :slug LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $product = $stmt->fetch();

        return $product ?: null;
    }
}
