<?php
/** @var array $brand */
/** @var array|null $order */
/** @var array $items */
$pageTitle = 'Track Order | ' . $brand['name'];
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-slate-900">Track your order</h1>
        <form class="mt-6 flex flex-col sm:flex-row gap-4 items-start" method="get" action="/cordygen/order-track">
            <input type="text" name="order_number" value="<?= htmlspecialchars($_GET['order_number'] ?? '') ?>" placeholder="Enter order number" class="flex-1 px-4 py-3 border border-slate-200 rounded-xl">
            <button class="brand-button inline-flex items-center px-6 py-3 rounded-full font-semibold">Check status</button>
        </form>
        <?php if ($order): ?>
            <div class="mt-10 border border-slate-200 rounded-2xl p-6 bg-orange-50">
                <h2 class="text-lg font-semibold text-slate-900">Order <?= htmlspecialchars($order['order_number']) ?></h2>
                <p class="mt-2 text-sm text-slate-600">Status: <span class="font-semibold text-orange-600"><?= htmlspecialchars($order['status']) ?></span></p>
                <p class="mt-2 text-sm text-slate-600">Payment: <?= strtoupper($order['payment_status']) ?></p>
                <div class="mt-6 space-y-3">
                    <?php foreach ($items as $item): ?>
                        <div class="flex justify-between border border-slate-200 rounded-xl p-4 bg-white">
                            <span class="text-sm text-slate-700"><?= htmlspecialchars($item['product_name']) ?> (x<?= $item['quantity'] ?>)</span>
                            <span class="text-sm font-semibold text-slate-900"><?= format_currency((float) $item['total']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php elseif (!empty($_GET['order_number'])): ?>
            <div class="mt-10 border border-red-200 bg-red-50 text-sm text-red-600 rounded-2xl p-5">
                We could not find an order with that number. Please verify and try again.
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
