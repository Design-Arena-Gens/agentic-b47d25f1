<?php
/** @var array $brand */
/** @var array $posts */
$pageTitle = 'Cordygen Journal | Cordyceps Science';
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-5xl mx-auto px-4">
        <div class="text-center max-w-3xl mx-auto">
            <span class="inline-flex items-center px-4 py-1 text-xs font-semibold uppercase tracking-widest text-orange-600 bg-orange-100 rounded-full">Cordygen Journal</span>
            <h1 class="mt-6 text-4xl font-bold text-slate-900">Research-backed insights on cordyceps physiology</h1>
            <p class="mt-4 text-slate-600 text-sm leading-relaxed">Stay updated with potency analytics, formulation R&D, and performance use-cases.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-8 mt-14">
            <?php foreach ($posts as $post): ?>
                <a href="/cordygen/blog/<?= $post['slug'] ?>" class="group border border-slate-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-lg transition">
                    <img src="<?= htmlspecialchars($post['cover_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <p class="text-xs uppercase tracking-widest text-orange-600 font-semibold"><?= date('d M Y', strtotime($post['published_at'] ?? 'now')) ?></p>
                        <h3 class="mt-3 text-xl font-semibold text-slate-900 group-hover:text-orange-600 transition"><?= htmlspecialchars($post['title']) ?></h3>
                        <p class="mt-3 text-sm text-slate-600"><?= htmlspecialchars($post['excerpt']) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
