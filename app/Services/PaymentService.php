<?php

declare(strict_types=1);

namespace App\Services;

use App\Core\Config;
use Exception;

final class PaymentService
{
    public function createRazorpayOrder(float $amount, string $receipt): array
    {
        $key = Config::get('razorpay.key');
        $secret = Config::get('razorpay.secret');

        if (!$key || !$secret) {
            throw new Exception('Razorpay credentials are missing.');
        }

        $payload = [
            'amount' => (int) ($amount * 100),
            'currency' => Config::get('razorpay.currency', 'INR'),
            'receipt' => $receipt,
            'payment_capture' => Config::get('razorpay.capture', true) ? 1 : 0,
        ];

        $ch = curl_init('https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_USERPWD, $key . ':' . $secret);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception('Failed to connect to Razorpay: ' . curl_error($ch));
        }

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($statusCode >= 400) {
            throw new Exception('Razorpay responded with status ' . $statusCode . ': ' . $response);
        }

        return json_decode($response, true, 512, JSON_THROW_ON_ERROR);
    }

    public function verifySignature(string $orderId, string $paymentId, string $signature): bool
    {
        $secret = Config::get('razorpay.secret');
        $generatedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $secret);
        return hash_equals($generatedSignature, $signature);
    }
}
