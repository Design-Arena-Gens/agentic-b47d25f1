<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Request;
use App\Services\BrandService;
use App\Services\CartService;
use App\Core\Session;
use App\Http\Response;

final class BrandPageController extends Controller
{
    private BrandService $brandService;
    private CartService $cartService;

    public function __construct()
    {
        $this->brandService = new BrandService();
        $this->cartService = new CartService();
    }

    public function home(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        $hero = $this->brandService->getContent($brandSlug, 'hero', []);
        $products = $this->brandService->getProducts($brandSlug);
        $posts = $this->brandService->getBlogPosts($brandSlug);

        return $this->view("{$brandSlug}.home", [
            'brand' => $brand,
            'hero' => $hero,
            'products' => $products,
            'posts' => $posts,
            'cart' => $this->cartService->all(),
            'totals' => $this->cartService->totals(),
        ]);
    }

    public function page(Request $request, string $brandSlug, string $pageSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        $page = $this->brandService->getPage($brandSlug, $pageSlug);

        return $this->view("{$brandSlug}.page", [
            'brand' => $brand,
            'page' => $page,
            'pageSlug' => $pageSlug,
        ]);
    }

    public function products(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        $products = $this->brandService->getProducts($brandSlug);

        return $this->view("{$brandSlug}.products", [
            'brand' => $brand,
            'products' => $products,
        ]);
    }

    public function productDetail(Request $request, string $brandSlug, string $slug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        $product = $this->brandService->getProduct($brandSlug, $slug);

        if (!$product) {
            return Response::make('Product not found', 404);
        }

        return $this->view("{$brandSlug}.product-detail", [
            'brand' => $brand,
            'product' => $product,
        ]);
    }

    public function blog(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        $posts = $this->brandService->getBlogPosts($brandSlug);

        return $this->view("{$brandSlug}.blog", [
            'brand' => $brand,
            'posts' => $posts,
        ]);
    }

    public function blogDetail(Request $request, string $brandSlug, string $slug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        $post = $this->brandService->getBlogPost($brandSlug, $slug);

        if (!$post) {
            return Response::make('Blog post not found', 404);
        }

        return $this->view("{$brandSlug}.blog-detail", [
            'brand' => $brand,
            'post' => $post,
        ]);
    }

    public function contact(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        return $this->view("{$brandSlug}.contact", [
            'brand' => $brand,
        ]);
    }

    public function faq(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        $items = $this->brandService->getFaq($brandSlug);

        return $this->view("{$brandSlug}.faq", [
            'brand' => $brand,
            'items' => $items,
        ]);
    }

    public function cart(Request $request, string $brandSlug): Response
    {
        $brand = $this->brandService->getBrand($brandSlug);
        if (!$brand) {
            return Response::make('Brand not found', 404);
        }

        return $this->view("{$brandSlug}.cart", [
            'brand' => $brand,
            'cart' => $this->cartService->all(),
            'totals' => $this->cartService->totals(),
        ]);
    }

    public function addToCart(Request $request, string $brandSlug): Response
    {
        if (!$this->brandService->getBrand($brandSlug)) {
            return Response::make('Brand not found', 404);
        }
        $slug = $request->input('slug');
        $quantity = (int) $request->input('quantity', 1);
        $product = $this->brandService->getProduct($brandSlug, $slug);

        if ($product) {
            $this->cartService->add($product, max(1, $quantity));
        }

        return Response::redirect("/{$brandSlug}/cart");
    }

    public function updateCart(Request $request, string $brandSlug): Response
    {
        if (!$this->brandService->getBrand($brandSlug)) {
            return Response::make('Brand not found', 404);
        }
        $items = $request->input('items', []);
        foreach ($items as $slug => $quantity) {
            $this->cartService->update($slug, (int) $quantity);
        }

        return Response::redirect("/{$brandSlug}/cart");
    }

    public function removeFromCart(Request $request, string $brandSlug, string $slug): Response
    {
        if (!$this->brandService->getBrand($brandSlug)) {
            return Response::make('Brand not found', 404);
        }
        $this->cartService->remove($slug);
        return Response::redirect("/{$brandSlug}/cart");
    }
}
