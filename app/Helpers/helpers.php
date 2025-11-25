<?php

use App\Models\Brand;

if (!function_exists('brand_cache')) {
    function brand_cache(): array
    {
        static $cache;
        if ($cache !== null) {
            return $cache;
        }

        $cacheFile = __DIR__ . '/../../storage/cache/brands.php';

        if (file_exists($cacheFile)) {
            $cache = require $cacheFile;
            return $cache;
        }

        $model = new Brand();
        $brands = $model->all();

        if (!$brands) {
            $brands = \App\Core\Config::get('brands.fallback', []);
        }

        if (!is_dir(dirname($cacheFile))) {
            mkdir(dirname($cacheFile), 0775, true);
        }

        $export = '<?php return ' . var_export($brands, true) . ';';
        file_put_contents($cacheFile, $export);

        $cache = $brands;
        return $cache;
    }
}

if (!function_exists('brand_from_slug')) {
    function brand_from_slug(string $slug): ?array
    {
        $brands = brand_cache();
        foreach ($brands as $brand) {
            if ($brand['slug'] === $slug) {
                return $brand;
            }
        }

        return null;
    }
}

if (!function_exists('format_currency')) {
    function format_currency(float $amount, string $currencySymbol = '₹'): string
    {
        return $currencySymbol . number_format($amount, 2);
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return '/assets/' . ltrim($path, '/');
    }
}

if (!function_exists('brand_route')) {
    function brand_route(string $brandSlug, string $path = ''): string
    {
        $path = ltrim($path, '/');
        return '/' . trim($brandSlug . '/' . $path, '/');
    }
}

if (!function_exists('config')) {
    function config(string $key, $default = null)
    {
        return \App\Core\Config::get($key, $default);
    }
}
