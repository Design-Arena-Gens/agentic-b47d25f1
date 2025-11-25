<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Shnikh Platform</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.1/dist/tailwind.min.css">
</head>
<body class="bg-slate-950 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-md w-full bg-white/10 backdrop-blur border border-white/10 rounded-3xl p-8 text-white">
        <div class="text-center">
            <h1 class="text-2xl font-semibold">Welcome back</h1>
            <p class="mt-2 text-sm text-slate-300">Shnikh Platform Admin Console</p>
        </div>
        <?php $error = \App\Core\Session::pullFlash('auth_error'); ?>
        <?php if ($error): ?>
            <div class="mt-6 p-3 bg-red-500/20 border border-red-500/50 text-sm text-red-200 rounded-xl">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="/admin/login" method="post" class="mt-6 space-y-4">
            <div>
                <label class="text-sm text-slate-200">Email</label>
                <input type="email" name="email" required class="mt-1 w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400">
            </div>
            <div>
                <label class="text-sm text-slate-200">Password</label>
                <input type="password" name="password" required class="mt-1 w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl focus:outline-none focus:ring-2 focus:ring-emerald-400">
            </div>
            <button class="w-full inline-flex items-center justify-center px-4 py-3 bg-emerald-500 text-white font-semibold rounded-xl hover:bg-emerald-400 transition">Sign in</button>
        </form>
    </div>
</body>
</html>
