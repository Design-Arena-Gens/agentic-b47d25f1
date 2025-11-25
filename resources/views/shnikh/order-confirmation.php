<?php
/** @var array $brand */
/** @var array $order */
/** @var array $items */
/** @var array|null $payment */
$pageTitle = 'Order Confirmed | ' . $brand['name'];
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4">
        <div class="border border-emerald-200 bg-emerald-50 rounded-3xl p-8 text-center">
            <div class="w-14 h-14 rounded-full bg-emerald-500/20 text-emerald-700 flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-emerald-900">Order Confirmed!</h1>
            <p class="mt-3 text-sm text-emerald-800">Your order number is <strong><?= htmlspecialchars($order['order_number']) ?></strong>. Our team will coordinate logistics shortly.</p>
        </div>

        <div class="mt-10 grid md:grid-cols-2 gap-8">
            <div class="border border-slate-200 rounded-2xl p-6">
                <h2 class="text-lg font-semibold text-slate-900">Order Summary</h2>
                <dl class="mt-4 text-sm text-slate-600 space-y-2">
                    <div class="flex justify-between"><dt>Status</dt><dd class="font-semibold text-emerald-600"><?= htmlspecialchars($order['status']) ?></dd></div>
                    <div class="flex justify-between"><dt>Total</dt><dd><?= format_currency((float) $order['total_amount']) ?></dd></div>
                    <div class="flex justify-between"><dt>Payment</dt><dd><?= strtoupper($order['payment_method']) ?></dd></div>
                </dl>
                <?php if ($payment): ?>
                    <div class="mt-4 rounded-xl bg-slate-100 p-4 text-xs text-slate-600">
                        <p><strong>Razorpay Order:</strong> <?= htmlspecialchars($payment['id']) ?></p>
                        <p class="mt-2">Complete payment via the popup window. Contact support if the payment did not trigger.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="border border-slate-200 rounded-2xl p-6">
                <h2 class="text-lg font-semibold text-slate-900">Shipping</h2>
                <p class="mt-3 text-sm text-slate-600 leading-relaxed">
                    <?= htmlspecialchars($order['shipping_name']) ?><br>
                    <?= nl2br(htmlspecialchars($order['shipping_address'])) ?><br>
                    <?= htmlspecialchars($order['shipping_city']) ?>, <?= htmlspecialchars($order['shipping_state']) ?> <?= htmlspecialchars($order['shipping_zip']) ?><br>
                    <?= htmlspecialchars($order['shipping_country']) ?>
                </p>
                <p class="mt-4 text-sm text-slate-500">Phone: <?= htmlspecialchars($order['shipping_phone']) ?></p>
            </div>
        </div>

        <div class="mt-12 border border-slate-200 rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-slate-900">Items</h2>
            <div class="mt-4 space-y-4">
                <?php foreach ($items as $item): ?>
                    <div class="flex items-center justify-between border border-slate-100 rounded-xl p-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-800"><?= htmlspecialchars($item['product_name']) ?></p>
                            <p class="text-xs text-slate-500">Qty <?= $item['quantity'] ?> x <?= format_currency((float) $item['price']) ?></p>
                        </div>
                        <div class="text-sm font-semibold text-slate-900"><?= format_currency((float) $item['total']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="mt-10 flex flex-col sm:flex-row gap-4">
            <a href="/shnikh/products" class="brand-button inline-flex items-center justify-center px-5 py-3 rounded-full font-semibold">Continue Shopping</a>
            <a href="/shnikh/order-track?order_number=<?= urlencode($order['order_number']) ?>" class="inline-flex items-center justify-center px-5 py-3 border border-emerald-500 text-emerald-600 rounded-full font-semibold hover:bg-emerald-50 transition">Track Order</a>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
