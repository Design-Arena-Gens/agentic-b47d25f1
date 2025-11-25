<?php
/** @var array|null $post */
/** @var array $brands */
$pageTitle = $post ? 'Edit Blog Post' : 'Create Blog Post';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<form action="<?= $post ? '/admin/blog/' . $post['id'] : '/admin/blog' ?>" method="post" class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Title</label>
            <input name="title" value="<?= htmlspecialchars($post['title'] ?? '') ?>" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Slug</label>
            <input name="slug" value="<?= htmlspecialchars($post['slug'] ?? '') ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Brand</label>
        <select name="brand_id" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['id'] ?>" <?= isset($post['brand_id']) && (int) $post['brand_id'] === (int) $brand['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($brand['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Status</label>
            <select name="status" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
                <option value="draft" <?= ($post['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
                <option value="published" <?= ($post['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
            </select>
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Publish Date</label>
            <input type="date" name="published_at" value="<?= htmlspecialchars(substr($post['published_at'] ?? '', 0, 10)) ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Cover Image URL</label>
        <input name="cover_image" value="<?= htmlspecialchars($post['cover_image'] ?? '') ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Excerpt</label>
        <textarea name="excerpt" rows="3" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg"><?= htmlspecialchars($post['excerpt'] ?? '') ?></textarea>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Content</label>
        <textarea name="content" rows="10" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg"><?= htmlspecialchars($post['content'] ?? '') ?></textarea>
    </div>
    <button class="inline-flex items-center px-5 py-3 bg-emerald-500 text-white rounded-lg text-sm font-semibold">Save Post</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
