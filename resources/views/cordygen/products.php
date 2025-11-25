<?php
/** @var array $brand */
/** @var array $products */
$pageTitle = 'Cordygen Products | Cordyceps Wellness';
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
            <div>
                <h1 class="text-4xl font-bold text-slate-900">Cordyceps Wellness Line</h1>
                <p class="mt-3 text-slate-600">Potent adaptogenic formulations with QR-verifiable certificates of analysis.</p>
            </div>
            <a href="/cordygen/contact" class="brand-button inline-flex items-center px-5 py-3 rounded-full font-semibold">Schedule consultation</a>
        </div>
        <div class="grid md:grid-cols-3 gap-8 mt-12">
            <?php foreach ($products as $product): ?>
                <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-lg transition">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-52 object-cover">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-slate-900"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="mt-2 text-sm text-slate-600"><?= htmlspecialchars($product['short_description']) ?></p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-base font-semibold text-orange-600"><?= format_currency((float) ($product['discount_price'] ?? $product['price'])) ?></span>
                            <a href="/cordygen/products/<?= $product['slug'] ?>" class="text-sm font-semibold text-orange-600 hover:text-orange-500">View detail →</a>
                        </div>
                    </div>
                    <form action="/cordygen/cart/add" method="post" class="border-t border-slate-200 p-4">
                        <input type="hidden" name="slug" value="<?= $product['slug'] ?>">
                        <button class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-semibold border border-orange-500 text-orange-600 rounded-full hover:bg-orange-50 transition">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
