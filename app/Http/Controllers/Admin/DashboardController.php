<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\Services\AuthService;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

final class DashboardController extends Controller
{
    private AuthService $auth;
    private Order $orders;
    private User $users;
    private Product $products;

    public function __construct()
    {
        $this->auth = new AuthService();
        $this->orders = new Order();
        $this->users = new User();
        $this->products = new Product();
    }

    public function index(): Response
    {
        $metrics = [
            'orders' => count($this->orders->all()),
            'users' => count($this->users->all()),
            'products' => count($this->products->all()),
        ];

        return $this->view('admin.dashboard', [
            'metrics' => $metrics,
            'user' => $this->auth->user(),
        ]);
    }
}
