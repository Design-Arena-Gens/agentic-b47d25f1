<?php
/** @var array $brand */
/** @var array $hero */
/** @var array $products */
/** @var array $posts */
$pageTitle = 'Shnikh Agrobiotech | Plant Tissue Culture';
ob_start();
?>
<section class="relative overflow-hidden">
    <div class="max-w-6xl mx-auto px-4 py-16 lg:py-24">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div>
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-widest text-emerald-700 bg-emerald-100 rounded-full mb-6">Shnikh Agrobiotech</span>
                <h1 class="text-4xl font-bold text-slate-900 lg:text-5xl"><?= htmlspecialchars($hero['title'] ?? 'Precision plant tissue culture programs at scale') ?></h1>
                <p class="mt-5 text-lg text-slate-600 leading-relaxed"><?= htmlspecialchars($hero['subtitle'] ?? 'We deliver genetically uniform plantlets, elite cultivars, and contract biotechnology solutions for agribusinesses.') ?></p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="/shnikh/services" class="brand-button inline-flex items-center px-5 py-3 rounded-full font-semibold shadow-lg shadow-emerald-500/30 hover:-translate-y-0.5 transition"><?= htmlspecialchars($hero['cta_primary'] ?? 'Explore Services') ?></a>
                    <a href="/shnikh/contact" class="inline-flex items-center px-5 py-3 border border-emerald-500/40 text-emerald-800 rounded-full font-semibold hover:bg-emerald-50 transition"><?= htmlspecialchars($hero['cta_secondary'] ?? 'Contact Science Team') ?></a>
                </div>
                <dl class="mt-12 grid grid-cols-2 gap-6">
                    <div class="bg-emerald-50 border border-emerald-100 rounded-2xl p-5">
                        <dt class="text-sm font-medium text-emerald-700">Annual capacity</dt>
                        <dd class="text-2xl font-bold text-emerald-900 mt-2">800K+</dd>
                    </div>
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5">
                        <dt class="text-sm font-medium text-slate-600">Cleanroom standards</dt>
                        <dd class="text-2xl font-bold text-slate-900 mt-2">ISO 14644</dd>
                    </div>
                </dl>
            </div>
            <div class="relative">
                <div class="absolute -inset-6 bg-gradient-to-tr from-emerald-200 to-emerald-400 opacity-40 blur-3xl"></div>
                <div class="relative bg-white rounded-3xl border border-slate-200 shadow-2xl overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=80" alt="Tissue culture lab" class="w-full h-80 object-cover">
                    <div class="p-6">
                        <p class="text-sm font-semibold text-emerald-600 uppercase tracking-widest">Lab Snapshot</p>
                        <p class="mt-2 text-slate-600 text-sm">Micropropagation facility with automated bioreactors, acclimatization greenhouses, and QC analytics.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-16 border-t border-b border-slate-100">
    <div class="max-w-6xl mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <?php foreach (config('content.shnikh.services') as $service): ?>
                <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50 hover:shadow-md transition">
                    <h3 class="text-xl font-semibold text-slate-900"><?= htmlspecialchars($service['title']) ?></h3>
                    <p class="mt-3 text-sm text-slate-600 leading-relaxed"><?= htmlspecialchars($service['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="bg-slate-900 text-white py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-10">
            <div class="max-w-xl">
                <h2 class="text-3xl font-bold leading-tight">Elite cultivar pipeline and molecular diagnostics for crop resilience.</h2>
                <p class="mt-4 text-slate-300 text-base leading-relaxed">Leverage our molecular diagnostics suite for clonal fidelity, pathogen indexing, and trait screening. Partner with Shnikh to pilot new cultivars faster.</p>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-2xl p-6 flex-1">
                <h3 class="text-sm font-semibold uppercase tracking-widest text-emerald-200">R&D Modules</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-200">
                    <li>• Molecular marker assisted screening</li>
                    <li>• Biostimulant efficacy trials and analytics</li>
                    <li>• Protected cultivation for acclimatization</li>
                    <li>• Cryo-preservation & germplasm banking</li>
                </ul>
                <a href="/shnikh/r-and-d" class="mt-6 inline-flex items-center text-sm font-semibold text-emerald-200 hover:text-white transition">Dive into R&amp;D <span class="ml-2">→</span></a>
            </div>
        </div>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-bold text-slate-900">Highlighted Plantlets</h2>
            <a href="/shnikh/products" class="text-sm font-semibold text-emerald-600 hover:text-emerald-500">View all products →</a>
        </div>
        <div class="grid md:grid-cols-3 gap-8 mt-10">
            <?php foreach (array_slice($products, 0, 3) as $product): ?>
                <a href="/shnikh/products/<?= $product['slug'] ?>" class="group border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-xl transition">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="w-full h-56 object-cover">
                    <div class="p-6">
                        <p class="text-xs uppercase text-emerald-500 font-semibold tracking-widest mb-2">Plantlet</p>
                        <h3 class="text-lg font-semibold text-slate-900 group-hover:text-emerald-600 transition"><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="mt-3 text-sm text-slate-600"><?= htmlspecialchars($product['short_description']) ?></p>
                        <p class="mt-4 text-base font-semibold text-slate-900"><?= format_currency((float) $product['price']) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="bg-emerald-950 py-20">
    <div class="max-w-5xl mx-auto px-4 text-center text-white">
        <h2 class="text-3xl font-bold">Partner with Shnikh Agrobiotech</h2>
        <p class="mt-4 text-slate-200">Book a discovery call to explore custom micropropagation programs, pathogen indexing, or contract biotech R&amp;D. We collaborate with nurseries, agritech startups, and research institutes to scale impact.</p>
        <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/shnikh/contact" class="brand-button inline-flex items-center px-5 py-3 rounded-full font-semibold">Book Consultation</a>
            <a href="/shnikh/r-and-d" class="inline-flex items-center px-5 py-3 border border-emerald-400/50 text-emerald-200 rounded-full font-semibold hover:bg-emerald-900 transition">View R&amp;D Labs</a>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
