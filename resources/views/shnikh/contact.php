<?php
/** @var array $brand */
$pageTitle = 'Contact Shnikh Agrobiotech';
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-slate-900">Partner with Shnikh Agrobiotech</h1>
            <p class="mt-4 text-slate-600">Share your project to unlock a custom plant tissue culture roadmap.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-10 mt-12">
            <div class="border border-slate-200 rounded-2xl p-6 bg-slate-50">
                <h2 class="text-lg font-semibold text-slate-900">WhatsApp & Email</h2>
                <p class="mt-3 text-sm text-slate-600">+91 98765 43210<br>lab@shnikhagrobiotech.com</p>
                <h3 class="mt-6 text-sm font-semibold uppercase tracking-widest text-emerald-600">Campus</h3>
                <p class="mt-2 text-sm text-slate-600">Biotech Innovation Park, Pune<br>ISO 14644 certified cleanroom + acclimatization facility</p>
                <div class="mt-6 text-sm text-slate-500">
                    <p>Mon - Sat: 9:00 AM to 6:00 PM IST</p>
                </div>
            </div>
            <form class="space-y-4 border border-slate-200 rounded-2xl p-6 shadow-sm" method="post" action="/lead">
                <input type="hidden" name="brand" value="shnikh">
                <div>
                    <label class="text-sm font-semibold text-slate-700">Name</label>
                    <input type="text" name="name" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" required class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Phone</label>
                    <input type="text" name="phone" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700">Project Overview</label>
                    <textarea name="message" rows="4" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" placeholder="Plant species, volume, desired outcomes..."></textarea>
                </div>
                <button class="brand-button inline-flex items-center px-5 py-3 rounded-full font-semibold">Submit Inquiry</button>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
