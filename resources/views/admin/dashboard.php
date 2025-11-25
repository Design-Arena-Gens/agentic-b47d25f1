<?php
/** @var array $metrics */
$pageTitle = 'Dashboard';
$authUser = (new \App\Services\AuthService())->user();
ob_start();
?>
<div class="grid md:grid-cols-3 gap-6">
    <div class="bg-white border border-slate-100 rounded-2xl p-6">
        <p class="text-xs uppercase tracking-widest text-slate-500 font-semibold">Orders</p>
        <p class="mt-3 text-3xl font-bold text-slate-900"><?= $metrics['orders'] ?></p>
    </div>
    <div class="bg-white border border-slate-100 rounded-2xl p-6">
        <p class="text-xs uppercase tracking-widest text-slate-500 font-semibold">Users</p>
        <p class="mt-3 text-3xl font-bold text-slate-900"><?= $metrics['users'] ?></p>
    </div>
    <div class="bg-white border border-slate-100 rounded-2xl p-6">
        <p class="text-xs uppercase tracking-widest text-slate-500 font-semibold">Products</p>
        <p class="mt-3 text-3xl font-bold text-slate-900"><?= $metrics['products'] ?></p>
    </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/layout.php';
