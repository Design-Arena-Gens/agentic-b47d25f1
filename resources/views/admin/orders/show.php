<?php
/** @var array $order */
/** @var array $items */
$pageTitle = 'Order ' . $order['order_number'];
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<div class="grid lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-slate-900">Customer</h2>
            <p class="mt-3 text-sm text-slate-600">
                <?= htmlspecialchars($order['shipping_name']) ?><br>
                <?= htmlspecialchars($order['shipping_email']) ?><br>
                <?= htmlspecialchars($order['shipping_phone']) ?>
            </p>
            <h3 class="text-sm font-semibold uppercase tracking-widest text-slate-500 mt-6">Shipping</h3>
            <p class="mt-2 text-sm text-slate-600">
                <?= nl2br(htmlspecialchars($order['shipping_address'])) ?><br>
                <?= htmlspecialchars($order['shipping_city']) ?>, <?= htmlspecialchars($order['shipping_state']) ?> <?= htmlspecialchars($order['shipping_zip']) ?><br>
                <?= htmlspecialchars($order['shipping_country']) ?>
            </p>
        </div>
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-slate-900">Items</h2>
            <div class="mt-4 space-y-4">
                <?php foreach ($items as $item): ?>
                    <div class="flex justify-between border border-slate-100 rounded-xl p-4">
                        <div>
                            <p class="text-sm font-semibold text-slate-800"><?= htmlspecialchars($item['product_name']) ?></p>
                            <p class="text-xs text-slate-500">SKU <?= htmlspecialchars($item['sku']) ?> • Qty <?= $item['quantity'] ?></p>
                        </div>
                        <div class="text-sm font-semibold text-slate-900"><?= format_currency((float) $item['total']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <aside class="space-y-6">
        <?php $flash = \App\Core\Session::pullFlash('order_success'); ?>
        <?php if ($flash): ?>
            <div class="p-3 bg-emerald-50 border border-emerald-200 text-sm text-emerald-700 rounded-lg"><?= htmlspecialchars($flash) ?></div>
        <?php endif; ?>
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <h2 class="text-lg font-semibold text-slate-900">Order Summary</h2>
            <dl class="mt-4 text-sm text-slate-600 space-y-2">
                <div class="flex justify-between"><dt>Order #</dt><dd><?= htmlspecialchars($order['order_number']) ?></dd></div>
                <div class="flex justify-between"><dt>Status</dt><dd><span class="inline-flex px-2 py-1 rounded-full text-xs bg-emerald-100 text-emerald-700"><?= htmlspecialchars($order['status']) ?></span></dd></div>
                <div class="flex justify-between"><dt>Total</dt><dd><?= format_currency((float) $order['total_amount']) ?></dd></div>
                <div class="flex justify-between"><dt>Payment</dt><dd><?= strtoupper($order['payment_method']) ?> / <?= htmlspecialchars($order['payment_status']) ?></dd></div>
            </dl>
            <form action="/admin/orders/<?= $order['id'] ?>/status" method="post" class="mt-6 space-y-3">
                <label class="text-sm font-semibold text-slate-700">Update status</label>
                <select name="status" class="w-full px-4 py-2 border border-slate-200 rounded-lg">
                    <?php foreach (['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status): ?>
                        <option value="<?= $status ?>" <?= $order['status'] === $status ? 'selected' : '' ?>><?= ucfirst($status) ?></option>
                    <?php endforeach; ?>
                </select>
                <button class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white rounded-lg text-sm font-semibold">Update</button>
            </form>
        </div>
    </aside>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
