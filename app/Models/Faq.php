<?php

declare(strict_types=1);

namespace App\Models;

final class Faq extends Model
{
    protected string $table = 'faqs';
    protected array $fillable = [
        'brand_id',
        'question',
        'answer',
        'order_column',
        'is_active',
    ];

    public function activeForBrand(int $brandId): array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE brand_id = :brand_id AND is_active = 1 ORDER BY order_column ASC");
        $stmt->execute(['brand_id' => $brandId]);
        return $stmt->fetchAll();
    }
}
