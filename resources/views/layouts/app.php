<?php
/** @var array|null $brand */
/** @var string $content */

$baseTitle = $brand['name'] ?? 'Shnikh Platform';
$primaryColor = $brand['primary_color'] ?? '#0f172a';
$secondaryColor = $brand['secondary_color'] ?? '#22d3ee';
$brandSlug = $brand['slug'] ?? null;
$brandList = brand_cache();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? $baseTitle) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/app.css') ?>">
    <style>
        :root {
            --brand-primary: <?= $primaryColor ?>;
            --brand-secondary: <?= $secondaryColor ?>;
        }
        body { font-family: 'Inter', sans-serif; }
        .brand-gradient {
            background-image: linear-gradient(135deg, var(--brand-primary), var(--brand-secondary));
        }
        .brand-link:hover { color: var(--brand-secondary); }
        .brand-button {
            background-color: var(--brand-primary);
            color: #fff;
        }
        .brand-button:hover { background-color: var(--brand-secondary); }
    </style>
</head>
<body class="bg-slate-50 text-slate-950">
    <header class="border-b bg-white/80 backdrop-blur sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-4">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full brand-gradient shadow-lg"></div>
                    <div>
                        <a href="<?= $brandSlug ? '/' . $brandSlug . '/home' : '/' ?>" class="text-lg font-bold text-slate-900">
                            <?= htmlspecialchars($brand['name'] ?? 'Shnikh Platform') ?>
                        </a>
                        <p class="text-sm text-slate-500"><?= htmlspecialchars($brand['tagline'] ?? 'Agri-biotech & wellness innovations') ?></p>
                    </div>
                </div>
                <nav class="hidden md:flex items-center space-x-6 text-sm font-medium">
                    <?php if ($brandSlug === 'shnikh'): ?>
                        <a class="brand-link transition" href="/shnikh/home">Home</a>
                        <a class="brand-link transition" href="/shnikh/about">About</a>
                        <a class="brand-link transition" href="/shnikh/services">Services</a>
                        <a class="brand-link transition" href="/shnikh/products">Products</a>
                        <a class="brand-link transition" href="/shnikh/r-and-d">R&amp;D</a>
                        <a class="brand-link transition" href="/shnikh/blog">Blog</a>
                        <a class="brand-link transition" href="/shnikh/contact">Contact</a>
                    <?php elseif ($brandSlug === 'cordygen'): ?>
                        <a class="brand-link transition" href="/cordygen/home">Home</a>
                        <a class="brand-link transition" href="/cordygen/products">Products</a>
                        <a class="brand-link transition" href="/cordygen/science">Science</a>
                        <a class="brand-link transition" href="/cordygen/blog">Blog</a>
                        <a class="brand-link transition" href="/cordygen/faq">FAQ</a>
                        <a class="brand-link transition" href="/cordygen/contact">Contact</a>
                    <?php else: ?>
                        <a class="brand-link transition" href="/">Platform</a>
                    <?php endif; ?>
                </nav>
                <div class="flex items-center space-x-3">
                    <?php if ($brandSlug): ?>
                        <a href="/<?= $brandSlug ?>/cart" class="inline-flex items-center px-4 py-2 text-sm font-semibold border rounded-full border-slate-200 hover:border-slate-400 transition">
                            Cart
                        </a>
                    <?php endif; ?>
                    <div class="relative">
                        <button id="brandSwitcherButton" class="inline-flex items-center px-4 py-2 text-sm font-semibold border rounded-full border-slate-200 hover:border-slate-400 transition">
                            Switch brand
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 9l6 6 6-6"></path>
                            </svg>
                        </button>
                        <div id="brandSwitcherMenu" class="hidden absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl border border-slate-100">
                            <div class="py-2">
                                <?php foreach ($brandList as $switchBrand): ?>
                                    <a href="/<?= $switchBrand['slug'] ?>/home" class="flex px-4 py-3 hover:bg-slate-50">
                                        <div class="w-9 h-9 rounded-full mr-3" style="background-image: linear-gradient(135deg, <?= $switchBrand['primary_color'] ?>, <?= $switchBrand['secondary_color'] ?>);"></div>
                                        <div>
                                            <p class="text-sm font-semibold"><?= htmlspecialchars($switchBrand['name']) ?></p>
                                            <p class="text-xs text-slate-500"><?= htmlspecialchars($switchBrand['tagline']) ?></p>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                                <div class="border-t border-slate-100 mt-2"></div>
                                <a href="/" class="flex px-4 py-3 text-sm hover:bg-slate-50">
                                    Platform Landing
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <?= $content ?>
    </main>

    <footer class="bg-slate-900 text-slate-200 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="w-12 h-12 rounded-full brand-gradient mb-4"></div>
                    <h3 class="text-lg font-semibold mb-2"><?= htmlspecialchars($brand['name'] ?? 'Shnikh Platform') ?></h3>
                    <p class="text-sm text-slate-400 leading-relaxed"><?= htmlspecialchars($brand['tagline'] ?? 'Transforming agri-biotech and wellness with science-first solutions.') ?></p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wide text-slate-400 mb-4">Navigation</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a class="hover:text-white transition" href="/">Platform Landing</a></li>
                        <li><a class="hover:text-white transition" href="/shnikh/home">Shnikh Agrobiotech</a></li>
                        <li><a class="hover:text-white transition" href="/cordygen/home">Cordygen Wellness</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wide text-slate-400 mb-4">Support</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a class="hover:text-white transition" href="/<?= $brandSlug ?? 'shnikh' ?>/contact">Contact</a></li>
                        <li><a class="hover:text-white transition" href="/<?= $brandSlug ?? 'shnikh' ?>/order-track">Order Tracking</a></li>
                        <li><a class="hover:text-white transition" href="/cordygen/faq">FAQ</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wide text-slate-400 mb-4">Admin</h4>
                    <p class="text-sm text-slate-400">For team members managing content & commerce.</p>
                    <a href="/admin" class="inline-flex items-center mt-4 px-4 py-2 bg-white text-slate-900 rounded-full text-sm font-semibold shadow hover:shadow-lg transition">Admin Portal</a>
                </div>
            </div>
            <div class="mt-10 border-t border-slate-800 pt-6 text-xs text-slate-500 flex flex-col sm:flex-row sm:justify-between">
                <span>© <?= date('Y') ?> Shnikh Agrobiotech Platform. All rights reserved.</span>
                <span>Made with precision biotech & cordyceps science.</span>
            </div>
        </div>
    </footer>

    <script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>
