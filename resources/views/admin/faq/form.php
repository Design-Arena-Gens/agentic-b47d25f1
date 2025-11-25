<?php
/** @var array|null $faq */
/** @var array $brands */
$pageTitle = $faq ? 'Edit FAQ' : 'Create FAQ';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<form action="<?= $faq ? '/admin/faqs/' . $faq['id'] : '/admin/faqs' ?>" method="post" class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
    <div>
        <label class="text-sm font-semibold text-slate-700">Question</label>
        <input name="question" value="<?= htmlspecialchars($faq['question'] ?? '') ?>" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
    </div>
    <div>
        <label class="text-sm font-semibold text-slate-700">Answer</label>
        <textarea name="answer" rows="5" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg"><?= htmlspecialchars($faq['answer'] ?? '') ?></textarea>
    </div>
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Brand</label>
            <select name="brand_id" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= $brand['id'] ?>" <?= isset($faq['brand_id']) && (int) $faq['brand_id'] === (int) $brand['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($brand['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Order</label>
            <input name="order_column" type="number" value="<?= htmlspecialchars($faq['order_column'] ?? 0) ?>" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div>
        <label class="inline-flex items-center text-sm text-slate-600">
            <input type="checkbox" name="is_active" <?= !empty($faq['is_active']) ? 'checked' : '' ?> class="mr-2">
            Active
        </label>
    </div>
    <button class="inline-flex items-center px-5 py-3 bg-emerald-500 text-white rounded-lg text-sm font-semibold">Save FAQ</button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
