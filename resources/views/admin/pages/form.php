<?php
/** @var array|null $page */
/** @var array $brands */
$pageTitle = $page ? 'Edit Page' : 'Create Page';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<form action="<?= $page ? '/admin/pages/' . $page['id'] : '/admin/pages' ?>" method="post" class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Title</label>
            <input name="title" value="<?= htmlspecialchars($page['title'] ?? '') ?>" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Slug</label>
            <input name="slug" value="<?= htmlspecialchars($page['slug'] ?? '') ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Brand</label>
        <select name="brand_id" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['id'] ?>" <?= isset($page['brand_id']) && (int) $page['brand_id'] === (int) $brand['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($brand['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Content</label>
        <textarea name="content" rows="10" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg"><?= htmlspecialchars($page['content'] ?? '') ?></textarea>
    </div>
    <div class="flex items-center space-x-4">
        <label class="inline-flex items-center text-sm text-slate-600">
            <input type="checkbox" name="is_active" <?= !empty($page['is_active']) ? 'checked' : '' ?> class="mr-2">
            Published
        </label>
    </div>
    <button class="inline-flex items-center px-5 py-3 bg-emerald-500 text-white rounded-lg text-sm font-semibold">Save Page</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
