<?php
/** @var array $brand */
$pageTitle = 'Edit Brand';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<form action="/admin/brands/<?= $brand['id'] ?>" method="post" class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
    <div>
        <label class="text-sm font-semibold text-slate-700">Name</label>
        <input name="name" value="<?= htmlspecialchars($brand['name']) ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Slug</label>
        <input name="slug" value="<?= htmlspecialchars($brand['slug']) ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Tagline</label>
        <input name="tagline" value="<?= htmlspecialchars($brand['tagline']) ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
    </div>
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Primary Color</label>
            <input name="primary_color" value="<?= htmlspecialchars($brand['primary_color']) ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Secondary Color</label>
            <input name="secondary_color" value="<?= htmlspecialchars($brand['secondary_color']) ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Meta Description</label>
        <textarea name="meta_description" rows="3" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg"><?= htmlspecialchars($brand['meta_description']) ?></textarea>
    </div>
    <button class="inline-flex items-center px-5 py-3 bg-emerald-500 text-white rounded-lg text-sm font-semibold">Update Brand</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
