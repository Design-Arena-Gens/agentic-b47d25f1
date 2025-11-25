<?php
/** @var array $brands */
$pageTitle = 'Brands';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<?php $flash = \App\Core\Session::pullFlash('brand_success'); ?>
<?php if ($flash): ?>
    <div class="mb-6 p-3 bg-emerald-50 border border-emerald-200 text-sm text-emerald-700 rounded-lg"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-slate-600 uppercase tracking-widest text-xs font-semibold">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Slug</th>
                <th class="px-4 py-3 text-left">Tagline</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            <?php foreach ($brands as $brand): ?>
                <tr>
                    <td class="px-4 py-3 font-semibold text-slate-800"><?= htmlspecialchars($brand['name']) ?></td>
                    <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars($brand['slug']) ?></td>
                    <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars($brand['tagline']) ?></td>
                    <td class="px-4 py-3 text-right">
                        <a href="/admin/brands/<?= $brand['id'] ?>" class="text-sm font-semibold text-emerald-600">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
