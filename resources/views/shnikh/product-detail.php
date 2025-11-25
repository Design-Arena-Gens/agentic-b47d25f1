<?php
/** @var array $brand */
/** @var array $product */
$pageTitle = $product['name'] . ' | ' . $brand['name'];
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-10">
            <div class="border border-slate-200 rounded-3xl overflow-hidden shadow-sm">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-96 object-cover">
            </div>
            <div>
                <span class="inline-flex items-center px-3 py-1 text-xs uppercase font-semibold tracking-widest text-emerald-600 bg-emerald-100 rounded-full">Plantlet</span>
                <h1 class="mt-4 text-4xl font-bold text-slate-900"><?= htmlspecialchars($product['name']) ?></h1>
                <p class="mt-4 text-slate-600 text-sm leading-relaxed"><?= htmlspecialchars($product['short_description']) ?></p>
                <div class="mt-6 flex items-center gap-4">
                    <span class="text-2xl font-bold text-emerald-700"><?= format_currency((float) ($product['discount_price'] ?? $product['price'])) ?></span>
                    <?php if (!empty($product['discount_price'])): ?>
                        <span class="text-sm text-slate-400 line-through"><?= format_currency((float) $product['price']) ?></span>
                    <?php endif; ?>
                </div>
                <form action="/shnikh/cart/add" method="post" class="mt-6 space-y-4">
                    <input type="hidden" name="slug" value="<?= $product['slug'] ?>">
                    <div>
                        <label class="text-xs uppercase text-slate-500 tracking-widest font-semibold">Quantity</label>
                        <input type="number" name="quantity" value="10" min="1" class="mt-1 w-24 px-3 py-2 border border-slate-200 rounded-lg">
                    </div>
                    <button class="brand-button inline-flex items-center px-5 py-3 rounded-full font-semibold">Add to Cart</button>
                </form>
                <div class="mt-10">
                    <h2 class="text-lg font-semibold text-slate-900">Cultivar Insights</h2>
                    <p class="mt-3 text-sm text-slate-600"><?= $product['description'] ?? 'Detailed cultivar specifications can be managed from the admin panel.' ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
