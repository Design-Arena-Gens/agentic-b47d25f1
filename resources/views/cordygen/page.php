<?php
/** @var array $brand */
/** @var array|null $page */
/** @var string $pageSlug */
$pageTitle = ($page['title'] ?? ucfirst(str_replace('-', ' ', $pageSlug))) . ' | ' . $brand['name'];
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4">
        <span class="inline-flex items-center px-3 py-1 text-xs uppercase font-semibold tracking-widest text-orange-600 bg-orange-100 rounded-full mb-6"><?= htmlspecialchars($brand['name']) ?></span>
        <h1 class="text-4xl font-bold text-slate-900"><?= htmlspecialchars($page['title'] ?? ucfirst(str_replace('-', ' ', $pageSlug))) ?></h1>
        <div class="mt-6 prose prose-orange max-w-none">
            <?= $page['content'] ?? '<p>Content to be added. Manage this page via Admin.</p>' ?>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
