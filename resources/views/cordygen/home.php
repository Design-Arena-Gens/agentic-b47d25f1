<?php
/** @var array $brand */
/** @var array $hero */
/** @var array $products */
/** @var array $posts */
$pageTitle = 'Cordygen | Cordyceps Wellness';
ob_start();
?>
<section class="relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 py-16 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-widest text-orange-600 bg-orange-100 rounded-full mb-6">Cordygen Wellness</span>
                <h1 class="text-4xl font-bold text-slate-900 lg:text-5xl"><?= htmlspecialchars($hero['title'] ?? 'Cordyceps-powered vitality for performance and recovery') ?></h1>
                <p class="mt-5 text-lg text-slate-600 leading-relaxed"><?= htmlspecialchars($hero['subtitle'] ?? 'Bioactive cordyceps formulas engineered with clinical benchmarks for athletes, professionals, and wellness seekers.') ?></p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="/cordygen/products" class="brand-button inline-flex items-center px-5 py-3 rounded-full font-semibold shadow-lg shadow-orange-500/30 hover:-translate-y-0.5 transition"><?= htmlspecialchars($hero['cta_primary'] ?? 'Shop Products') ?></a>
                    <a href="/cordygen/science" class="inline-flex items-center px-5 py-3 border border-orange-400/60 text-orange-700 rounded-full font-semibold hover:bg-orange-50 transition"><?= htmlspecialchars($hero['cta_secondary'] ?? 'Read the Science') ?></a>
                </div>
                <div class="mt-10 grid grid-cols-2 gap-6">
                    <div class="border border-orange-200 bg-orange-50 rounded-2xl p-5">
                        <h3 class="text-sm font-semibold text-orange-700 uppercase tracking-widest">Cordycepin per serving</h3>
                        <p class="mt-2 text-2xl font-bold text-orange-900">120mg</p>
                    </div>
                    <div class="border border-slate-200 bg-white rounded-2xl p-5">
                        <h3 class="text-sm font-semibold text-slate-600 uppercase tracking-widest">Testing</h3>
                        <p class="mt-2 text-2xl font-bold text-slate-900">3x</p>
                        <p class="text-xs text-slate-500 mt-1">Potency • Heavy Metals • Microbial</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute -inset-6 bg-gradient-to-tr from-orange-200 to-red-300 opacity-40 blur-3xl"></div>
                <div class="relative bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1615485290382-3a3b265653b7?auto=format&fit=crop&w=900&q=80" alt="Cordyceps wellness" class="w-full h-80 object-cover">
                    <div class="p-6">
                        <p class="text-sm font-semibold text-orange-600 uppercase tracking-widest">Formulation Lab</p>
                        <p class="mt-2 text-slate-600 text-sm">Bio-fermentation workflows optimize cordyceps metabolite expression with strict QA controls.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-10">
            <?php foreach (config('content.cordygen.science.pillars') as $pillar): ?>
                <div class="border border-slate-200 rounded-2xl p-6 bg-orange-50/40 hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-slate-900"><?= htmlspecialchars($pillar['title']) ?></h3>
                    <p class="mt-3 text-sm text-slate-600"><?= htmlspecialchars($pillar['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="bg-slate-950 text-white py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl font-bold leading-tight">Validated by independent labs & clinical advisors</h2>
                <p class="mt-4 text-slate-300">Every Cordygen batch ships with a QR-verifiable certificate of analysis for total cordycepin, adenosine, beta-glucans, and safety metrics.</p>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-2xl p-6">
                <h3 class="text-sm font-semibold uppercase tracking-widest text-orange-200">Highlights</h3>
                <ul class="mt-3 space-y-3 text-sm text-slate-100">
                    <li>• Transparent sourcing & vertical farm traceability</li>
                    <li>• PQC, microbiological, and heavy metal certification</li>
                    <li>• Evidence-backed dosages aligned to research</li>
                    <li>• Vegan capsules & functional beverage integrations</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-slate-900">Featured Products</h2>
            <a href="/cordygen/products" class="text-sm font-semibold text-orange-600 hover:text-orange-500">Browse all →</a>
        </div>
        <div class="grid md:grid-cols-3 gap-8 mt-12">
            <?php foreach (array_slice($products, 0, 3) as $product): ?>
                <div class="border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-xl transition">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-slate-900"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="mt-3 text-sm text-slate-600"><?= htmlspecialchars($product['short_description']) ?></p>
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

<section class="bg-orange-50 py-16">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-slate-900">Clinically benchmarked adaptogens in modern formats</h2>
        <p class="mt-4 text-slate-600">Experience Cordyceps militaris in capsules, powders, ready-to-drink beverages, and B2B nutraceutical integrations. Launch private label offerings with compliant documentation.</p>
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/cordygen/contact" class="brand-button inline-flex items-center px-5 py-3 rounded-full font-semibold">Talk to sales</a>
            <a href="/cordygen/faq" class="inline-flex items-center px-5 py-3 border border-orange-400 text-orange-700 rounded-full font-semibold hover:bg-white transition">View FAQs</a>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
