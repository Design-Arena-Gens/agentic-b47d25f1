<?php
/** @var string $content */
/** @var string|null $pageTitle */
/** @var array|null $user */
$pageTitle = $pageTitle ?? 'Admin | Shnikh Platform';
$authUser = $authUser ?? (new \App\Services\AuthService())->user();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css">
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
</head>
<body class="bg-slate-100">
    <div class="flex min-h-screen">
        <aside class="w-64 bg-slate-950 text-slate-100 flex flex-col">
            <div class="px-6 py-5 border-b border-slate-900">
                <a href="/admin" class="text-xl font-semibold">Shnikh Admin</a>
                <p class="text-xs text-slate-400 mt-2"><?= htmlspecialchars($authUser['email'] ?? '') ?></p>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1 text-sm font-medium">
                <a href="/admin" class="block px-3 py-2 rounded-lg hover:bg-slate-900">Dashboard</a>
                <a href="/admin/orders" class="block px-3 py-2 rounded-lg hover:bg-slate-900">Orders</a>
                <a href="/admin/products" class="block px-3 py-2 rounded-lg hover:bg-slate-900">Products</a>
                <a href="/admin/blog" class="block px-3 py-2 rounded-lg hover:bg-slate-900">Blog</a>
                <a href="/admin/pages" class="block px-3 py-2 rounded-lg hover:bg-slate-900">Pages</a>
                <a href="/admin/faqs" class="block px-3 py-2 rounded-lg hover:bg-slate-900">FAQs</a>
                <a href="/admin/brands" class="block px-3 py-2 rounded-lg hover:bg-slate-900">Brands</a>
                <a href="/admin/users" class="block px-3 py-2 rounded-lg hover:bg-slate-900">Users</a>
            </nav>
            <form action="/admin/logout" method="post" class="px-4 py-6 border-t border-slate-900">
                <button class="w-full inline-flex items-center justify-center px-3 py-2 bg-red-500 text-white rounded-lg text-sm font-semibold">Sign out</button>
            </form>
        </aside>
        <main class="flex-1">
            <header class="bg-white border-b border-slate-200 px-8 py-5">
                <h1 class="text-2xl font-semibold text-slate-900"><?= htmlspecialchars($pageTitle) ?></h1>
            </header>
            <div class="p-8">
                <?= $content ?>
            </div>
        </main>
    </div>
</body>
</html>
