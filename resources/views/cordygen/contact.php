<?php
/** @var array $brand */
$pageTitle = 'Contact Cordygen Wellness';
ob_start();
?>
<section class="bg-white py-16">
    <div class="max-w-4xl mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-slate-900">Connect with Cordygen</h1>
            <p class="mt-4 text-slate-600">Partner with us for distribution, private label, or clinical collaborations.</p>
        </div>
        <div class="grid md:grid-cols-2 gap-10 mt-12">
            <div class="border border-slate-200 rounded-2xl p-6 bg-orange-50">
                <h2 class="text-lg font-semibold text-slate-900">Direct channels</h2>
                <p class="mt-3 text-sm text-slate-600">+91 91234 56789<br>hello@cordygen.in</p>
                <h3 class="mt-6 text-sm font-semibold uppercase tracking-widest text-orange-600">Headquarters</h3>
                <p class="mt-2 text-sm text-slate-600">Cordyceps Innovation Lab, Bengaluru<br>GMP certified production & testing</p>
                <div class="mt-6 text-sm text-slate-500">
                    <p>Mon - Sat: 9:30 AM to 6:30 PM IST</p>
                </div>
            </div>
            <form class="space-y-4 border border-slate-200 rounded-2xl p-6 shadow-sm" method="post" action="/lead">
                <input type="hidden" name="brand" value="cordygen">
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
                    <label class="text-sm font-semibold text-slate-700">How can we support you?</label>
                    <textarea name="message" rows="4" class="mt-1 w-full px-4 py-2 border border-slate-200 rounded-lg" placeholder="Wholesale partnership, product development, athlete program..."></textarea>
                </div>
                <button class="brand-button inline-flex items-center px-5 py-3 rounded-full font-semibold">Submit Request</button>
            </form>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
