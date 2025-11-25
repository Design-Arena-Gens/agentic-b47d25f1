<?php

declare(strict_types=1);

namespace App\Models;

final class BlogPost extends Model
{
    protected string $table = 'blog_posts';
    protected array $fillable = [
        'brand_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published_at',
    ];

    public function publishedForBrand(int $brandId): array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE brand_id = :brand_id AND status = 'published' ORDER BY published_at DESC");
        $stmt->execute(['brand_id' => $brandId]);
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE slug = :slug AND status = 'published' LIMIT 1");
        $stmt->execute(['slug' => $slug]);
        $post = $stmt->fetch();
        return $post ?: null;
    }
}
