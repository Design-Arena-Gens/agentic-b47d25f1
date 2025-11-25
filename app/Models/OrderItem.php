<?php

declare(strict_types=1);

namespace App\Models;

final class OrderItem extends Model
{
    protected string $table = 'order_items';
    protected array $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'sku',
        'price',
        'quantity',
        'total',
    ];

    public function forOrder(int $orderId): array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE order_id = :order_id");
        $stmt->execute(['order_id' => $orderId]);
        return $stmt->fetchAll();
    }
}
