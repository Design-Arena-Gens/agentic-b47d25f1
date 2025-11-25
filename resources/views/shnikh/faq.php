<?php
/** @var array $brand */
/** @var array $items */
$pageTitle = 'FAQs | ' . $brand['name'];
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4">
        <h1 class="text-3xl font-bold text-slate-900">Frequently Asked Questions</h1>
        <div class="mt-8 space-y-4">
            <?php foreach ($items as $index => $item): ?>
                <details class="border border-slate-200 rounded-2xl">
                    <summary class="cursor-pointer px-5 py-4 text-sm font-semibold text-slate-800"><?= htmlspecialchars($item['question'] ?? $item['title']) ?></summary>
                    <div class="px-5 pb-4 text-sm text-slate-600"><?= nl2br(htmlspecialchars($item['answer'] ?? '')) ?></div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
