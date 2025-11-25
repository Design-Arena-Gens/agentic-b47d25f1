<?php
$pageTitle = 'Shnikh Platform | Dual-Brand Innovation Hub';
$brand = null;
ob_start();
?>
<section class="relative bg-slate-950 text-white overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/20 via-cyan-500/10 to-indigo-500/10"></div>
        <div class="absolute inset-0 opacity-40 mix-blend-overlay" style="background-image: url('https://images.unsplash.com/photo-1545239351-1141bd82e8a6?auto=format&fit=crop&w=1600&q=80'); background-size: cover;"></div>
    </div>
    <div class="relative max-w-6xl mx-auto px-4 py-24 lg:py-32">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-widest text-emerald-300 bg-emerald-500/10 rounded-full ring-1 ring-emerald-500/30 mb-6">Agri-Biotech & Wellness</span>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight tracking-tight">One platform powering advanced plant tissue culture and cordyceps wellness breakthroughs.</h1>
                <p class="mt-6 text-lg text-slate-200 leading-relaxed">Shnikh Agrobiotech scales elite plant genetics and biotechnology R&D, while Cordygen formulates clinically benchmarked cordyceps wellness products. Explore the division aligned with your mission.</p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="#brand-selector" class="inline-flex items-center justify-center px-5 py-3 bg-white text-slate-900 rounded-full font-semibold shadow-lg hover:shadow-xl transition">Choose your division</a>
                    <a href="/admin" class="inline-flex items-center justify-center px-5 py-3 border border-white/30 rounded-full font-semibold text-white hover:bg-white/10 transition">Admin Portal</a>
                </div>
            </div>
            <div class="bg-white/5 backdrop-blur rounded-3xl border border-white/10 p-8 shadow-2xl">
                <h2 class="text-2xl font-semibold text-white mb-4">Connect with us</h2>
                <p class="text-sm text-slate-200 mb-6">Share your project goals so we can align you with the right division specialists.</p>
                <form action="/lead" method="post" class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-slate-200 mb-1 block">Name</label>
                        <input required type="text" name="name" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-lg text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-200 mb-1 block">Email</label>
                        <input required type="email" name="email" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-lg text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-400">
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-200 mb-1 block">Which division fits you?</label>
                        <select name="brand" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-emerald-400">
                            <?php foreach ($brands as $brandOption): ?>
                                <option value="<?= htmlspecialchars($brandOption['slug']) ?>"><?= htmlspecialchars($brandOption['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-slate-200 mb-1 block">What do you want to achieve?</label>
                        <textarea name="message" rows="3" class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-lg text-white placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-400" placeholder="Scale tissue culture production, launch cordyceps formulations, partner for biotechnology R&D..."></textarea>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center px-5 py-3 bg-emerald-500 text-white font-semibold rounded-full hover:bg-emerald-400 transition">Submit Inquiry</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section id="brand-selector" class="relative bg-white py-20">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold tracking-tight text-slate-900">Select a division to continue</h2>
            <p class="mt-4 text-lg text-slate-600">Tailored experiences for agri-biotech enterprises and cordyceps wellness innovators.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-10 mt-14">
            <a href="/shnikh/home" class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-br from-emerald-100 via-white to-emerald-50 p-8 transition shadow-sm hover:shadow-lg">
                <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-400/20 rounded-full blur-3xl group-hover:bg-emerald-400/30 transition"></div>
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-wider text-emerald-600 bg-emerald-500/10 rounded-full mb-6">Shnikh Agrobiotech</span>
                <h3 class="text-2xl font-semibold text-emerald-900">Plant Tissue Culture & Agri-Biotech</h3>
                <p class="mt-4 text-sm text-emerald-900/80 leading-relaxed">High-throughput micropropagation, molecular diagnostics, and contract biotechnology research for horticulture, plantation crops, and agri-enterprises.</p>
                <ul class="mt-6 space-y-3 text-sm text-emerald-900/70">
                    <li>• Commercial tissue culture supply chains</li>
                    <li>• Acclimatization and agronomy support</li>
                    <li>• Custom R&D collaborations</li>
                </ul>
                <div class="mt-8 inline-flex items-center text-sm font-semibold text-emerald-700">
                    Enter the division
                    <svg class="w-4 h-4 ml-2 transition translate-x-0 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </div>
            </a>
            <a href="/cordygen/home" class="group relative overflow-hidden rounded-3xl border border-slate-200 bg-gradient-to-br from-orange-50 via-white to-orange-100 p-8 transition shadow-sm hover:shadow-lg">
                <div class="absolute top-0 right-0 w-40 h-40 bg-orange-400/20 rounded-full blur-3xl group-hover:bg-orange-400/30 transition"></div>
                <span class="inline-flex items-center px-3 py-1 text-xs font-semibold uppercase tracking-wider text-orange-600 bg-orange-500/10 rounded-full mb-6">Cordygen Wellness</span>
                <h3 class="text-2xl font-semibold text-orange-900">Cordyceps Wellness Products</h3>
                <p class="mt-4 text-sm text-orange-900/80 leading-relaxed">Clinically benchmarked cordyceps formulations engineered for immunity, energy, and recovery with transparent supply chain traceability.</p>
                <ul class="mt-6 space-y-3 text-sm text-orange-900/70">
                    <li>• Cordycepin rich nutraceuticals</li>
                    <li>• GMP certified manufacturing</li>
                    <li>• E-commerce & D2C fulfillment</li>
                </ul>
                <div class="mt-8 inline-flex items-center text-sm font-semibold text-orange-700">
                    Enter the division
                    <svg class="w-4 h-4 ml-2 transition translate-x-0 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</section>

<section class="bg-slate-900 text-white py-16">
    <div class="max-w-5xl mx-auto px-4 text-center">
        <h2 class="text-3xl font-semibold">Trusted partners for sustainable bio-innovation</h2>
        <p class="mt-4 text-base text-slate-300 max-w-2xl mx-auto">
            Our combined platforms empower agri-enterprises, wellness brands, and research teams with lab-backed execution. Talk to us about scaling plant tissue culture, launching next-gen nutraceuticals, or crafting biotech partnerships.
        </p>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
