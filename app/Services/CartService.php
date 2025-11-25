<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Session;

final class CartService
{
    private const SESSION_KEY = 'cart_items';

    public function all(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    public function add(array $product, int $quantity = 1): void
    {
        $cart = $this->all();
        $slug = $product['slug'];

        if (isset($cart[$slug])) {
            $cart[$slug]['quantity'] += $quantity;
        } else {
            $cart[$slug] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => (float) ($product['discount_price'] ?? $product['price']),
                'quantity' => $quantity,
                'image' => $product['image'] ?? null,
            ];
        }

        Session::put(self::SESSION_KEY, $cart);
    }

    public function update(string $slug, int $quantity): void
    {
        $cart = $this->all();
        if (!isset($cart[$slug])) {
            return;
        }

        if ($quantity <= 0) {
            unset($cart[$slug]);
        } else {
            $cart[$slug]['quantity'] = $quantity;
        }

        Session::put(self::SESSION_KEY, $cart);
    }

    public function remove(string $slug): void
    {
        $cart = $this->all();
        unset($cart[$slug]);
        Session::put(self::SESSION_KEY, $cart);
    }

    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    public function totals(): array
    {
        $cart = $this->all();
        $subtotal = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0.0);

        $shipping = $subtotal > 999 ? 0.0 : 99.0;
        $total = $subtotal + $shipping;

        return [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
        ];
    }
}
