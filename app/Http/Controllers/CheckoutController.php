<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CheckoutRequest;
use App\Http\Request;
use App\Http\Response;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\BrandService;
use App\Services\CartService;
use App\Services\PaymentService;
use App\Core\Session;
use Exception;

final class CheckoutController extends Controller
{
    private BrandService $brandService;
    private CartService $cartService;
    private Order $orders;
    private OrderItem $orderItems;
    private PaymentService $payments;

    public function __construct()
    {
        $this->brandService = new BrandService();
        $this->cartService = new CartService();
        $this->orders = new Order();
        $this->orderItems = new OrderItem();
        $this->payments = new PaymentService();
    }

    public function index(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }
        $cart = $this->cartService->all();
        $totals = $this->cartService->totals();

        if (!$cart) {
            return Response::redirect("/{$brandSlug}/cart");
        }

        return $this->view("{$brandSlug}.checkout", [
            'brand' => $brand,
            'cart' => $cart,
            'totals' => $totals,
        ]);
    }

    public function place(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }
        $cart = $this->cartService->all();

        if (!$cart) {
            return Response::redirect("/{$brandSlug}/cart");
        }

        try {
            $data = CheckoutRequest::validate($request);
        } catch (\InvalidArgumentException $exception) {
            Session::flash('checkout_error', $exception->getMessage());
            return Response::redirect("/{$brandSlug}/checkout");
        }

        $totals = $this->cartService->totals();
        $orderNumber = 'ORD-' . strtoupper($brandSlug) . '-' . date('YmdHis');

        $orderId = $this->orders->create([
            'brand_id' => $brand['id'] ?? 0,
            'user_id' => null,
            'order_number' => $orderNumber,
            'status' => 'pending',
            'total_amount' => $totals['total'],
            'payment_method' => $data['payment_method'],
            'payment_status' => $data['payment_method'] === 'cod' ? 'pending' : 'initiated',
            'shipping_name' => $data['name'],
            'shipping_email' => $data['email'],
            'shipping_phone' => $data['phone'],
            'shipping_address' => $data['address'],
            'shipping_city' => $data['city'],
            'shipping_state' => $data['state'],
            'shipping_zip' => $data['zip'],
            'shipping_country' => $data['country'],
            'notes' => $data['notes'],
        ]);

        foreach ($cart as $item) {
            $this->orderItems->create([
                'order_id' => $orderId,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'sku' => $item['slug'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        $paymentData = null;

        if ($data['payment_method'] === 'razorpay') {
            try {
                $paymentData = $this->payments->createRazorpayOrder($totals['total'], $orderNumber);
                $this->orders->update($orderId, [
                    'razorpay_order_id' => $paymentData['id'],
                ]);
            } catch (Exception $exception) {
                Session::flash('checkout_error', 'Payment gateway error: ' . $exception->getMessage());
                return Response::redirect("/{$brandSlug}/checkout");
            }
        } else {
            $this->orders->update($orderId, [
                'status' => 'confirmed',
            ]);
        }

        Session::put('last_order_id', $orderId);
        $this->cartService->clear();

        return $this->view("{$brandSlug}.order-confirmation", [
            'brand' => $brand,
            'order' => $this->orders->find($orderId),
            'items' => $this->orderItems->forOrder($orderId),
            'payment' => $paymentData,
        ]);
    }
}
