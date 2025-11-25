<?php

declare(strict_types=1);

namespace App\Models;

final class Order extends Model
{
    protected string $table = 'orders';
    protected array $fillable = [
        'brand_id',
        'user_id',
        'order_number',
        'status',
        'total_amount',
        'payment_method',
        'payment_status',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'shipping_country',
        'notes',
        'razorpay_order_id',
        'razorpay_payment_id',
        'razorpay_signature',
    ];

    public function findByOrderNumber(string $orderNumber): ?array
    {
        $stmt = $this->connection()->prepare("SELECT * FROM {$this->table} WHERE order_number = :order_number LIMIT 1");
        $stmt->execute(['order_number' => $orderNumber]);
        $order = $stmt->fetch();
        return $order ?: null;
    }
}
