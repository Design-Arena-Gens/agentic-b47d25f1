<?php
/** @var array $brand */
/** @var array $post */
$pageTitle = $post['title'] . ' | Shnikh Insights';
ob_start();
?>
<article class="bg-white py-16">
    <div class="max-w-3xl mx-auto px-4">
        <a href="/shnikh/blog" class="text-sm text-emerald-600 hover:text-emerald-500 font-semibold">&larr; Back to Insights</a>
        <h1 class="mt-4 text-4xl font-bold text-slate-900"><?= htmlspecialchars($post['title']) ?></h1>
        <p class="mt-3 text-sm text-slate-500 uppercase tracking-widest font-semibold"><?= date('d F Y', strtotime($post['published_at'] ?? 'now')) ?></p>
        <img src="<?= htmlspecialchars($post['cover_image']) ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="mt-8 w-full rounded-2xl border border-slate-200">
        <div class="prose prose-emerald mt-8 max-w-none">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>
    </div>
</article>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
