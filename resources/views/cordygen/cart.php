<?php
/** @var array $brand */
/** @var array $cart */
/** @var array $totals */
$pageTitle = 'Cart | ' . $brand['name'];
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-slate-900">Your Cart</h1>
        <?php if (!$cart): ?>
            <div class="mt-8 border border-dashed border-slate-200 rounded-2xl p-10 text-center">
                <p class="text-slate-500">Your cart is empty. Explore <a class="text-orange-600 font-semibold" href="/cordygen/products">Cordygen products</a> to add items.</p>
            </div>
        <?php else: ?>
            <form action="/cordygen/cart/update" method="post" class="mt-8 space-y-6">
                <?php foreach ($cart as $item): ?>
                    <div class="flex items-center gap-6 border border-slate-200 rounded-2xl p-6">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-24 h-24 object-cover rounded-xl">
                        <div class="flex-1">
                            <h2 class="text-lg font-semibold text-slate-900"><?= htmlspecialchars($item['name']) ?></h2>
                            <p class="text-sm text-slate-500 mt-1">Unit price: <?= format_currency($item['price']) ?></p>
                            <div class="mt-4 flex items-center gap-3">
                                <label class="text-sm text-slate-600">Qty</label>
                                <input type="number" name="items[<?= $item['slug'] ?>]" value="<?= $item['quantity'] ?>" min="1" class="w-20 px-3 py-2 border border-slate-200 rounded-lg">
                                <button type="submit" formaction="/cordygen/cart/remove/<?= $item['slug'] ?>" class="text-sm text-slate-500 hover:text-red-500 font-semibold">Remove</button>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-lg font-semibold text-slate-900"><?= format_currency($item['price'] * $item['quantity']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
                <div class="flex justify-end">
                    <button class="inline-flex items-center px-5 py-3 border border-orange-500 text-orange-600 rounded-full font-semibold hover:bg-orange-50 transition">Update Cart</button>
                </div>
            </form>

            <div class="mt-10 border border-slate-200 rounded-2xl p-6 bg-orange-50">
                <h2 class="text-lg font-semibold text-slate-900">Summary</h2>
                <dl class="mt-4 space-y-2 text-sm text-slate-600">
                    <div class="flex justify-between"><dt>Subtotal</dt><dd><?= format_currency($totals['subtotal']) ?></dd></div>
                    <div class="flex justify-between"><dt>Shipping</dt><dd><?= $totals['shipping'] === 0.0 ? 'Free' : format_currency($totals['shipping']) ?></dd></div>
                    <div class="flex justify-between text-base font-semibold text-slate-900"><dt>Total</dt><dd><?= format_currency($totals['total']) ?></dd></div>
                </dl>
                <a href="/cordygen/checkout" class="mt-6 brand-button inline-flex items-center justify-center px-5 py-3 rounded-full font-semibold">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
