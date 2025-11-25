<?php
/** @var array $brand */
/** @var array|null $page */
/** @var string $pageSlug */
$pageTitle = ($page['title'] ?? ucfirst(str_replace('-', ' ', $pageSlug))) . ' | ' . $brand['name'];
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-sm text-emerald-600 uppercase tracking-widest font-semibold"><?= htmlspecialchars($brand['name']) ?></div>
        <h1 class="text-4xl font-bold text-slate-900 mt-4"><?= htmlspecialchars($page['title'] ?? ucfirst(str_replace('-', ' ', $pageSlug))) ?></h1>
        <div class="mt-6 prose prose-emerald max-w-none">
            <?= $page['content'] ?? '<p>Content coming soon. Update this page via the Admin panel.</p>' ?>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
