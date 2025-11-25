<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Request;
use App\Http\Response;
use App\Models\Product;
use App\Models\Brand;
use App\Core\Session;

final class ProductController extends Controller
{
    private Product $products;
    private Brand $brands;

    public function __construct()
    {
        $this->products = new Product();
        $this->brands = new Brand();
    }

    public function index(): Response
    {
        return $this->view('admin.products.index', [
            'products' => $this->products->all(),
        ]);
    }

    public function create(): Response
    {
        return $this->view('admin.products.form', [
            'product' => null,
            'brands' => $this->brands->all(),
        ]);
    }

    public function store(Request $request): Response
    {
        $data = $request->all();

        $slug = $data['slug'] ?? '';
        if (!$slug) {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $data['name'] ?? 'product'));
        }
        $data['slug'] = $slug;
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $data['is_featured'] = isset($data['is_featured']) ? 1 : 0;

        $this->products->create($data);
        Session::flash('product_success', 'Product created successfully.');

        return Response::redirect('/admin/products');
    }

    public function edit(Request $request, string $id): Response
    {
        $product = $this->products->find((int) $id);
        return $this->view('admin.products.form', [
            'product' => $product,
            'brands' => $this->brands->all(),
        ]);
    }

    public function update(Request $request, string $id): Response
    {
        $data = $request->all();
        $data['is_active'] = isset($data['is_active']) ? 1 : 0;
        $data['is_featured'] = isset($data['is_featured']) ? 1 : 0;
        $this->products->update((int) $id, $data);

        Session::flash('product_success', 'Product updated.');
        return Response::redirect('/admin/products');
    }

    public function destroy(Request $request, string $id): Response
    {
        $this->products->delete((int) $id);
        Session::flash('product_success', 'Product deleted.');
        return Response::redirect('/admin/products');
    }
}
