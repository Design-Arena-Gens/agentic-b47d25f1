<?php
/** @var array $brand */
/** @var array $cart */
/** @var array $totals */
$pageTitle = 'Checkout | ' . $brand['name'];
$error = \App\Core\Session::pullFlash('checkout_error');
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-slate-900">Checkout</h1>
        <?php if ($error): ?>
            <div class="mt-6 p-4 border border-red-200 bg-red-50 text-sm text-red-700 rounded-xl">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <div class="mt-10 grid lg:grid-cols-5 gap-10">
            <form class="lg:col-span-3 space-y-5 border border-slate-200 rounded-2xl p-6" action="/cordygen/checkout" method="post">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Full Name</label>
                        <input name="name" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Email</label>
                        <input type="email" name="email" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" />
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Phone</label>
                        <input name="phone" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">Country</label>
                        <input name="country" value="India" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" />
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Address</label>
                    <textarea name="address" rows="2" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg"></textarea>
                </div>
                <div class="grid sm:grid-cols-3 gap-4">
                    <div>
                        <label class="text-sm font-semibold text-slate-700">City</label>
                        <input name="city" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">State</label>
                        <input name="state" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" />
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-700">PIN</label>
                        <input name="zip" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" />
                    </div>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Order Notes</label>
                    <textarea name="notes" rows="3" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" placeholder="Special delivery instructions, private label details..."></textarea>
                </div>
                <div>
                    <h2 class="text-sm font-semibold uppercase tracking-widest text-slate-500">Payment Options</h2>
                    <div class="mt-3 space-y-3">
                        <label class="flex items-start space-x-3 border border-slate-200 rounded-xl p-4">
                            <input type="radio" name="payment_method" value="cod" checked>
                            <span>
                                <span class="text-sm font-semibold text-slate-800">Cash on Delivery</span>
                                <p class="text-xs text-slate-500 mt-1">COD available across major metros with contactless collection.</p>
                            </span>
                        </label>
                        <label class="flex items-start space-x-3 border border-slate-200 rounded-xl p-4">
                            <input type="radio" name="payment_method" value="razorpay">
                            <span>
                                <span class="text-sm font-semibold text-slate-800">Razorpay Online Payment</span>
                                <p class="text-xs text-slate-500 mt-1">Pay instantly via UPI, cards, or wallets.</p>
                            </span>
                        </label>
                    </div>
                </div>
                <button class="brand-button inline-flex items-center px-6 py-3 rounded-full font-semibold">Place Order</button>
            </form>
            <aside class="lg:col-span-2 border border-slate-200 rounded-2xl p-6 bg-orange-50">
                <h2 class="text-lg font-semibold text-slate-900">Order Summary</h2>
                <div class="mt-4 space-y-4">
                    <?php foreach ($cart as $item): ?>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-slate-800"><?= htmlspecialchars($item['name']) ?></p>
                                <p class="text-xs text-slate-500"><?= $item['quantity'] ?> x <?= format_currency($item['price']) ?></p>
                            </div>
                            <div class="text-sm font-semibold text-slate-900"><?= format_currency($item['price'] * $item['quantity']) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <dl class="mt-6 space-y-2 text-sm text-slate-600">
                    <div class="flex justify-between"><dt>Subtotal</dt><dd><?= format_currency($totals['subtotal']) ?></dd></div>
                    <div class="flex justify-between"><dt>Shipping</dt><dd><?= $totals['shipping'] === 0.0 ? 'Free' : format_currency($totals['shipping']) ?></dd></div>
                    <div class="flex justify-between text-base font-semibold text-slate-900"><dt>Total</dt><dd><?= format_currency($totals['total']) ?></dd></div>
                </dl>
            </aside>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
