<?php
/** @var array $orders */
$pageTitle = 'Orders';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-slate-600 uppercase tracking-widest text-xs font-semibold">
            <tr>
                <th class="px-4 py-3 text-left">Order #</th>
                <th class="px-4 py-3 text-left">Brand</th>
                <th class="px-4 py-3 text-left">Customer</th>
                <th class="px-4 py-3 text-left">Total</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Payment</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td class="px-4 py-3 font-semibold text-slate-800"><?= htmlspecialchars($order['order_number']) ?></td>
                    <td class="px-4 py-3 text-slate-500"><?= $order['brand_id'] ?></td>
                    <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars($order['shipping_name']) ?></td>
                    <td class="px-4 py-3"><?= format_currency((float) $order['total_amount']) ?></td>
                    <td class="px-4 py-3">
                        <span class="inline-flex px-2 py-1 rounded-full text-xs bg-emerald-100 text-emerald-700"><?= htmlspecialchars($order['status']) ?></span>
                    </td>
                    <td class="px-4 py-3 text-slate-500"><?= strtoupper($order['payment_method']) ?> / <?= htmlspecialchars($order['payment_status']) ?></td>
                    <td class="px-4 py-3 text-right">
                        <a href="/admin/orders/<?= $order['id'] ?>" class="text-sm font-semibold text-emerald-600">View</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
