<?php
/** @var array|null $product */
/** @var array $brands */
$pageTitle = $product ? 'Edit Product' : 'Create Product';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<form action="<?= $product ? '/admin/products/' . $product['id'] : '/admin/products' ?>" method="post" class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Name</label>
            <input name="name" value="<?= htmlspecialchars($product['name'] ?? '') ?>" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Slug</label>
            <input name="slug" value="<?= htmlspecialchars($product['slug'] ?? '') ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Brand</label>
        <select name="brand_id" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
            <?php foreach ($brands as $brand): ?>
                <option value="<?= $brand['id'] ?>" <?= isset($product['brand_id']) && (int) $product['brand_id'] === (int) $brand['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($brand['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Price</label>
            <input name="price" type="number" step="0.01" value="<?= htmlspecialchars($product['price'] ?? '') ?>" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Discount Price</label>
            <input name="discount_price" type="number" step="0.01" value="<?= htmlspecialchars($product['discount_price'] ?? '') ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Stock</label>
            <input name="stock" type="number" value="<?= htmlspecialchars($product['stock'] ?? '') ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">SKU</label>
            <input name="sku" value="<?= htmlspecialchars($product['sku'] ?? '') ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Short Description</label>
        <textarea name="short_description" rows="3" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg"><?= htmlspecialchars($product['short_description'] ?? '') ?></textarea>
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Description</label>
        <textarea name="description" rows="4" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg"><?= htmlspecialchars($product['description'] ?? '') ?></textarea>
    </div>
    <div class="flex items-center space-x-4">
        <label class="inline-flex items-center text-sm text-slate-600">
            <input type="checkbox" name="is_active" <?= !empty($product['is_active']) ? 'checked' : '' ?> class="mr-2">
            Active
        </label>
        <label class="inline-flex items-center text-sm text-slate-600">
            <input type="checkbox" name="is_featured" <?= !empty($product['is_featured']) ? 'checked' : '' ?> class="mr-2">
            Featured
        </label>
    </div>
    <button class="inline-flex items-center px-5 py-3 bg-emerald-500 text-white rounded-lg text-sm font-semibold">Save Product</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
