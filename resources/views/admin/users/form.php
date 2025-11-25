<?php
/** @var array|null $user */
/** @var array $roles */
$pageTitle = $user ? 'Edit User' : 'Create User';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<form action="<?= $user ? '/admin/users/' . $user['id'] : '/admin/users' ?>" method="post" class="bg-white border border-slate-200 rounded-2xl p-6 space-y-5">
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Name</label>
            <input name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-5">
        <div>
            <label class="text-sm font-semibold text-slate-700">Password <?= $user ? '(leave blank to keep current)' : '' ?></label>
            <input type="password" name="password" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" <?= $user ? '' : 'required' ?>>
        </div>
        <div>
            <label class="text-sm font-semibold text-slate-700">Role</label>
            <select name="role_id" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role['id'] ?>" <?= isset($user['role_id']) && (int) $user['role_id'] === (int) $role['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($role['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <button class="inline-flex items-center px-5 py-3 bg-emerald-500 text-white rounded-lg text-sm font-semibold"><?= $user ? 'Update User' : 'Create User' ?></button>
</form>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layout.php';
