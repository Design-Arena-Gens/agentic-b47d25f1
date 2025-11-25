<?php
/** @var array $users */
$pageTitle = 'Users';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<div class="flex justify-between items-center mb-6">
    <h2 class="text-xl font-semibold text-slate-900">Users</h2>
    <a href="/admin/users/create" class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white rounded-lg text-sm font-semibold">Invite user</a>
</div>
<?php $flash = \App\Core\Session::pullFlash('user_success'); ?>
<?php if ($flash): ?>
    <div class="mb-6 p-3 bg-emerald-50 border border-emerald-200 text-sm text-emerald-700 rounded-lg"><?= htmlspecialchars($flash) ?></div>
<?php endif; ?>
<div class="bg-white border border-slate-200 rounded-2xl overflow-hidden">
    <table class="min-w-full divide-y divide-slate-200 text-sm">
        <thead class="bg-slate-50 text-slate-600 uppercase tracking-widest text-xs font-semibold">
            <tr>
                <th class="px-4 py-3 text-left">Name</th>
                <th class="px-4 py-3 text-left">Email</th>
                <th class="px-4 py-3 text-left">Role</th>
                <th class="px-4 py-3 text-left">Last login</th>
                <th class="px-4 py-3"></th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            <?php foreach ($users as $user): ?>
                <tr>
                    <td class="px-4 py-3 font-semibold text-slate-800"><?= htmlspecialchars($user['name']) ?></td>
                    <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars($user['email']) ?></td>
                    <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars($user['role_name'] ?? '') ?></td>
                    <td class="px-4 py-3 text-slate-500"><?= htmlspecialchars($user['last_login_at'] ?? '-') ?></td>
                    <td class="px-4 py-3 text-right">
                        <a href="/admin/users/<?= $user['id'] ?>/edit" class="text-sm font-semibold text-emerald-600 mr-3">Edit</a>
                        <form action="/admin/users/<?= $user['id'] ?>/delete" method="post" class="inline">
                            <button class="text-sm text-red-500 font-semibold">Remove</button>
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
