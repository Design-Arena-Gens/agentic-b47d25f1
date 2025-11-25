<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Brand;
use App\Models\Page;
use App\Models\Product;
use App\Models\BlogPost;
use App\Models\Faq;
use App\Core\Config;

final class BrandService
{
    private Brand $brands;
    private Page $pages;
    private Product $products;
    private BlogPost $blog;
    private Faq $faq;

    public function __construct()
    {
        $this->brands = new Brand();
        $this->pages = new Page();
        $this->products = new Product();
        $this->blog = new BlogPost();
        $this->faq = new Faq();
    }

    public function getBrand(string $slug): ?array
    {
        $brand = $this->brands->findBySlug($slug);

        if (!$brand) {
            $fallback = Config::get('brands.fallback', []);
            foreach ($fallback as $item) {
                if ($item['slug'] === $slug) {
                    return $item;
                }
            }
        }

        return $brand;
    }

    public function getPage(string $brandSlug, string $pageSlug): ?array
    {
        $brand = $this->getBrand($brandSlug);
        if (!$brand) {
            return null;
        }

        $page = $this->pages->findBySlugAndBrand($pageSlug, (int) $brand['id']);
        if ($page) {
            return $page;
        }

        $fallback = Config::get("content.{$brandSlug}.pages.{$pageSlug}");
        return $fallback ?: null;
    }

    public function getProducts(string $brandSlug): array
    {
        $brand = $this->getBrand($brandSlug);
        if (!$brand) {
            return [];
        }

        $products = $this->products->forBrand((int) $brand['id']);

        if ($products) {
            return $products;
        }

        return Config::get("products.{$brandSlug}", []);
    }

    public function getProduct(string $brandSlug, string $productSlug): ?array
    {
        $brand = $this->getBrand($brandSlug);
        if (!$brand) {
            return null;
        }

        $product = $this->products->findBySlug($productSlug);
        if ($product && (int) $product['brand_id'] === (int) $brand['id']) {
            return $product;
        }

        $fallback = $this->getProducts($brandSlug);
        foreach ($fallback as $item) {
            if ($item['slug'] === $productSlug) {
                return $item;
            }
        }

        return null;
    }

    public function getBlogPosts(string $brandSlug): array
    {
        $brand = $this->getBrand($brandSlug);
        if (!$brand) {
            return [];
        }

        $posts = $this->blog->publishedForBrand((int) $brand['id']);

        if ($posts) {
            return $posts;
        }

        return Config::get("blog.{$brandSlug}", []);
    }

    public function getBlogPost(string $brandSlug, string $slug): ?array
    {
        $brand = $this->getBrand($brandSlug);
        if (!$brand) {
            return null;
        }

        $post = $this->blog->findBySlug($slug);
        if ($post && (int) $post['brand_id'] === (int) $brand['id']) {
            return $post;
        }

        $fallback = $this->getBlogPosts($brandSlug);
        foreach ($fallback as $item) {
            if ($item['slug'] === $slug) {
                return $item;
            }
        }

        return null;
    }

    public function getFaq(string $brandSlug): array
    {
        $brand = $this->getBrand($brandSlug);
        if (!$brand) {
            return [];
        }

        $items = $this->faq->activeForBrand((int) $brand['id']);
        if ($items) {
            return $items;
        }

        $fallback = Config::get("content.{$brandSlug}.faq", []);
        return $fallback ?: [];
    }

    public function getContent(string $brandSlug, string $section, $default = null)
    {
        return Config::get("content.{$brandSlug}.{$section}", $default);
    }
}
