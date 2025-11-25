<?php
/** @var array $posts */
$pageTitle = 'Blog';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-slate-900">Blog Posts</h2>
    <a href="/admin/blog/create" class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white rounded-lg text-sm font-semibold">New Post</a>
</div>
<?php $flash = \App\Core\Session::pullFlash('blog_success'); ?>
<?php if ($flash): ?>
    <div class="mb-6 p-3 bg-emerald-50 border border-emerald-200 text-sm text-emerald-700 rounded-lg"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-slate-600 uppercase tracking-widest text-xs font-semibold">
            <tr>
                <th class="px-4 py-3 text-left">Title</th>
                <th class="px-4 py-3 text-left">Brand</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Published</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            <?php foreach ($posts as $post): ?>
                <tr>
                    <td class="px-4 py-3 font-medium text-slate-800"><?= htmlspecialchars($post['title']) ?></td>
                    <td class="px-4 py-3 text-slate-500"><?= $post['brand_id'] ?></td>
                    <td class="px-4 py-3">
                        <span class="inline-flex px-2 py-1 rounded-full text-xs <?= ($post['status'] ?? '') === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' ?>">
                            <?= htmlspecialchars($post['status'] ?? 'draft') ?>
                        </span>
                    </td>
                    <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars($post['published_at'] ?? '-') ?></td>
                    <td class="px-4 py-3 text-right">
                        <a href="/admin/blog/<?= $post['id'] ?>/edit" class="text-sm text-emerald-600 font-semibold mr-3">Edit</a>
                        <form action="/admin/blog/<?= $post['id'] ?>/delete" method="post" class="inline">
                            <button class="text-sm text-red-500 font-semibold">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
