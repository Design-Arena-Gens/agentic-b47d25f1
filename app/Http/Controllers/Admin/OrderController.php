<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\Response;
use App\Models\Order;
use App\Models\OrderItem;
use App\Core\Session;

final class OrderController extends Controller
{
    private Order $orders;
    private OrderItem $items;

    public function __construct()
    {
        $this->orders = new Order();
        $this->items = new OrderItem();
    }

    public function index(): Response
    {
        return $this->view('admin.orders.index', [
            'orders' => $this->orders->all(),
        ]);
    }

    public function show(Request $request, string $id): Response
    {
        $order = $this->orders->find((int) $id);
        $items = $this->items->forOrder((int) $id);

        return $this->view('admin.orders.show', [
            'order' => $order,
            'items' => $items,
        ]);
    }

    public function updateStatus(Request $request, string $id): Response
    {
        $status = $request->input('status', 'pending');
        $this->orders->update((int) $id, ['status' => $status]);
        Session::flash('order_success', 'Status updated.');
        return Response::redirect('/admin/orders/' . $id);
    }
}
