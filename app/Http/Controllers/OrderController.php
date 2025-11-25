<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\BrandService;
use App\Models\Order;
use App\Models\OrderItem;

final class OrderController extends Controller
{
    private BrandService $brandService;
    private Order $orders;
    private OrderItem $items;

    public function __construct()
    {
        $this->brandService = new BrandService();
        $this->orders = new Order();
        $this->items = new OrderItem();
    }

    public function track(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }
        $orderNumber = $request->input('order_number');
        $order = null;
        $items = [];

        if ($orderNumber) {
            $order = $this->orders->findByOrderNumber($orderNumber);
            if ($order) {
                $items = $this->items->forOrder((int) $order['id']);
            }
        }

        return $this->view("{$brandSlug}.order-track", [
            'brand' => $brand,
            'order' => $order,
            'items' => $items,
        ]);
    }
}
